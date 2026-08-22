<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\StudentAnswer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentAnswerController extends Controller
{
    
    public function index()
    {
        $studentAnswers = StudentAnswer::with(['student', 'homework', 'question'])
            ->get()
            ->groupBy(function ($answer) {
                return $answer->homework_id . '_' . $answer->student_id;
            })
            ->map(function ($group) {
               
                $totalMarks = $group->sum(function ($answer) {
                    $marks = $answer->question->marks ?? 0;
                    return $answer->is_correct && is_numeric($marks) ? (float) $marks : 0;
                });
    
                $maxMarks = $group->sum(function ($answer) {
                    return is_numeric($answer->question->marks) ? (float) $answer->question->marks : 0;
                });
    
           
                foreach ($group as $answer) {
                    $answer->update(['total_marks' => $totalMarks]);  
                    Log::info("Updated StudentAnswer with ID {$answer->id} and total_marks {$totalMarks}");
                }
    
                return [
                    'student' => $group->first()->student,
                    'homework' => $group->first()->homework,
                    'total_marks' => $totalMarks,
                    'max_marks' => $maxMarks,
                ];
            });
    
        return view('teacher.studentanswer.index', compact('studentAnswers'));
    }
    

   
    public function create($homeworkId)
    {
        $homework = Homework::with('question')->findOrFail($homeworkId);
        return view('teacher.studentanswer.create', compact('homework'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'homework_id' => 'required|exists:homeworks,id',
            'student_id' => 'required|exists:students,id',
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:questions,id',
            'answers.*.answer' => 'required|string',
        ]);

        foreach ($validatedData['answers'] as $answer) {
            $question = Question::find($answer['question_id']);
            $isCorrect = null;

            if ($question->type === 'radio' || $question->type === 'checkbox') {
                $correctAnswers = json_decode($question->options);
                $isCorrect = in_array($answer['answer'], $correctAnswers);
            }

            StudentAnswer::create([
                'homework_id' => $validatedData['homework_id'],
                'student_id' => $validatedData['student_id'],
                'question_id' => $answer['question_id'],
                'answer' => $answer['answer'],
                'is_correct' => $isCorrect,
            ]);
        }

        return redirect()->route('teacher.studentanswer.index')->with('success', 'تم إرسال الإجابات بنجاح!');
    }


public function show($id)
{
    Log::info("Attempting to fetch StudentAnswer with ID: {$id}");
    
    $studentAnswer = StudentAnswer::with(['student', 'homework', 'question'])->find($id);
    
    if (!$studentAnswer) {
        Log::error("StudentAnswer with ID {$id} not found");
        abort(404); 
    }

    return view('teacher.studentanswer.show', compact('studentAnswer'));
}


    public function edit($id)
    {
        $studentAnswer = StudentAnswer::findOrFail($id);
        return view('teacher.studentanswer.edit', compact('studentAnswer'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'answer' => 'required|string',
        ]);

        $studentAnswer = StudentAnswer::findOrFail($id);
        $studentAnswer->update($validatedData);

        return redirect()->route('teacher.studentanswer.index')->with('success', 'تم تحديث الإجابة بنجاح!');
    }

    public function destroy($id)
    {
        $studentAnswer = StudentAnswer::findOrFail($id);
        $studentAnswer->delete();
        return redirect()->route('teacher.studentanswer.index')->with('success', 'تم حذف الإجابة!');
    }
}
