<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Test;
use App\Models\Testanswer;
use App\Models\Testques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TestanswerController extends Controller
{
    public function index()
    {
        $courseIds = $this->enrolledCourseIds();
        $tests = Test::with('testques')
            ->whereIn('course_id', $courseIds)
            ->latest()
            ->get();

        return view('students.testanswer.index', ['testanswer' => $tests]);
    }

    public function create(Request $request)
    {
        $test = Test::with('testques')->findOrFail($request->integer('test_id'));
        $this->authorizeTest($test);

        return view('students.testanswer.create', compact('test'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'test_id' => ['required', 'integer', 'exists:test,id'],
            'answers' => ['required', 'array', 'min:1'],
            'answers.*.testques_id' => ['required', 'integer', 'exists:testques,id'],
            'answers.*.answer' => ['required'],
        ]);

        $studentId = (int) auth('students')->id();
        $test = Test::findOrFail($validated['test_id']);
        $this->authorizeTest($test);

        $questionIds = collect($validated['answers'])->pluck('testques_id')->map(fn ($id) => (int) $id);
        $questions = Testques::where('test_id', $test->id)
            ->whereIn('id', $questionIds)
            ->get()
            ->keyBy('id');

        if ($questions->count() !== $questionIds->unique()->count()) {
            throw ValidationException::withMessages([
                'answers' => 'One or more submitted questions do not belong to this test.',
            ]);
        }

        $earnedMarks = 0;
        $totalMarks = 0;

        DB::transaction(function () use ($validated, $studentId, $test, $questions, &$earnedMarks, &$totalMarks) {
            Testanswer::where('test_id', $test->id)
                ->where('student_id', $studentId)
                ->delete();

            foreach ($validated['answers'] as $answerData) {
                $question = $questions[(int) $answerData['testques_id']];
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

                Testanswer::create([
                    'test_id' => $test->id,
                    'student_id' => $studentId,
                    'testques_id' => $question->id,
                    'answer' => implode(',', $submittedValues),
                    'is_correct' => $isCorrect,
                    'type' => $test->type ?? 'test',
                ]);
            }

            Testanswer::where('test_id', $test->id)
                ->where('student_id', $studentId)
                ->update(['total_marks' => $earnedMarks]);
        });

        session(['earnedMarks' => $earnedMarks, 'totalMarks' => $totalMarks]);

        return redirect()->route('students.testanswer.result')
            ->with('success', "Your solution has been submitted! Your result: {$earnedMarks} / {$totalMarks}.");
    }

    public function show($id)
    {
        $testanswer = Testanswer::whereKey($id)
            ->where('student_id', auth('students')->id())
            ->firstOrFail();

        return view('students.testanswer.show', compact('testanswer'));
    }

    public function result()
    {
        return view('students.testanswer.result');
    }

    private function authorizeTest(Test $test): void
    {
        abort_unless($this->enrolledCourseIds()->contains((int) $test->course_id), 403);
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
