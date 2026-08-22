<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Homework;
use App\Models\Question;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StudentAnswerController extends Controller
{
    public function index()
    {
        $courseIds = $this->enrolledCourseIds();
        $homeworks = Homework::with('question')
            ->whereIn('course_id', $courseIds)
            ->latest()
            ->get();

        return view('students.studentanswer.index', compact('homeworks'));
    }

    public function create(Request $request)
    {
        $homework = Homework::with('question')->findOrFail($request->integer('homework_id'));
        $this->authorizeHomework($homework);

        return view('students.studentanswer.create', compact('homework'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'homework_id' => ['required', 'integer', 'exists:homeworks,id'],
            'answers' => ['required', 'array', 'min:1'],
            'answers.*.question_id' => ['required', 'integer', 'exists:question,id'],
            'answers.*.answer' => ['required'],
        ]);

        $studentId = (int) auth('students')->id();
        $homework = Homework::findOrFail($validated['homework_id']);
        $this->authorizeHomework($homework);

        $questionIds = collect($validated['answers'])->pluck('question_id')->map(fn ($id) => (int) $id);
        $questions = Question::where('homework_id', $homework->id)
            ->whereIn('id', $questionIds)
            ->get()
            ->keyBy('id');

        if ($questions->count() !== $questionIds->unique()->count()) {
            throw ValidationException::withMessages([
                'answers' => 'One or more submitted questions do not belong to this homework.',
            ]);
        }

        $earnedMarks = 0;
        $totalMarks = 0;

        DB::transaction(function () use ($validated, $studentId, $homework, $questions, &$earnedMarks, &$totalMarks) {
            StudentAnswer::where('homework_id', $homework->id)
                ->where('student_id', $studentId)
                ->delete();

            foreach ($validated['answers'] as $answerData) {
                $question = $questions[(int) $answerData['question_id']];
                $questionMark = (float) ($question->marks ?? 1);
                $totalMarks += $questionMark;

                $submittedValues = is_array($answerData['answer'])
                    ? array_map(fn ($value) => trim((string) $value), $answerData['answer'])
                    : [trim((string) $answerData['answer'])];

                $correctValues = json_decode($question->correct_answers ?? '[]', true);
                $correctValues = is_array($correctValues)
                    ? array_map(fn ($value) => trim((string) $value), $correctValues)
                    : [];

                sort($submittedValues);
                sort($correctValues);
                $isCorrect = $submittedValues === $correctValues;

                if ($isCorrect) {
                    $earnedMarks += $questionMark;
                }

                StudentAnswer::create([
                    'homework_id' => $homework->id,
                    'student_id' => $studentId,
                    'question_id' => $question->id,
                    'answer' => implode(',', $submittedValues),
                    'is_correct' => $isCorrect,
                    'type' => 'homework',
                ]);
            }

            StudentAnswer::where('homework_id', $homework->id)
                ->where('student_id', $studentId)
                ->update(['total_marks' => $earnedMarks]);
        });

        session(['earnedMarks' => $earnedMarks, 'totalMarks' => $totalMarks]);

        return redirect()->route('students.studentanswer.result')
            ->with('success', "Your solution has been submitted! Your result: {$earnedMarks} / {$totalMarks}.");
    }

    public function show($id)
    {
        $studentAnswer = StudentAnswer::whereKey($id)
            ->where('student_id', auth('students')->id())
            ->firstOrFail();

        return view('students.studentanswer.show', compact('studentAnswer'));
    }

    public function result()
    {
        return view('students.studentanswer.result');
    }

    private function authorizeHomework(Homework $homework): void
    {
        abort_unless($this->enrolledCourseIds()->contains((int) $homework->course_id), 403);
    }

    private function enrolledCourseIds()
    {
        return Enrollment::with('batch')
            ->where('student_id', auth('students')->id())
            ->get()
            ->pluck('batch.course_id')
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();
    }
}
