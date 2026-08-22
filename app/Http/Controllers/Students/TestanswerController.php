<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Testanswer;
use App\Models\Testques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestanswerController extends Controller
{
    
    public function index()
{
    $testanswer = Test::with('testques')->get();

    return view('students.testanswer.index', compact('testanswer'));
}


public function create(Request $request)
{
    $testId = $request->input('test_id');
    $test = Test::findOrFail($testId);

    return view('students.testanswer.create', compact('test'));
}


public function store(Request $request)
{
    
    $validatedData = $request->validate([
        'test_id' => 'required|exists:test,id',
        'student_id' => 'required|exists:students,id',
        'answers' => 'required|array',
        'answers.*.testques_id' => 'required|exists:testques,id',
        'answers.*.answer' => 'required',
    ]);

    $totalMarks = 0;  
    $earnedMarks = 0; 

    foreach ($validatedData['answers'] as $answerData) {
        $testques = Testques::findOrFail($answerData['testques_id']);

        
        $questionMark = $testques->marks ?? 1; 
        $totalMarks += $questionMark;

        $correctAnswers = json_decode($testques->correct_answers, true);

       
        $submittedAnswer = is_array($answerData['answer']) 
            ? implode(',', array_map('trim', $answerData['answer'])) 
            : trim($answerData['answer']);

      
        $isCorrect = is_array($correctAnswers) 
            ? in_array($submittedAnswer, array_map('trim', $correctAnswers)) 
            : trim($correctAnswers) == $submittedAnswer;

     
        if ($isCorrect) {
            $earnedMarks += $questionMark;
        }

       
        Testanswer::create([
            'test_id' => $validatedData['test_id'],
            'student_id' => $validatedData['student_id'],
            'testques_id' => $answerData['testques_id'],
            'answer' => $submittedAnswer,
            'is_correct' => $isCorrect,
            'total_marks' => $earnedMarks, 
        ]);
    }

   
    session(['earnedMarks' => $earnedMarks, 'totalMarks' => $totalMarks]);

    return redirect()->route('students.testanswer.result')
        ->with('success', "Your solution has been submitted! Your result : $earnedMarks / $totalMarks.");
}
  
    public function show($id)
    {
        $testanswer = Testanswer::findOrFail($id);
        return view('students.testanswer.show', compact('testanswer'));
    }


    public function result()
    {
        
  return view('students.testanswer.result');
        }
    

    
    
}
