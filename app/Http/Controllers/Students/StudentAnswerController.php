<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\StudentAnswer;
use App\Models\Question;
use App\Models\Students;
use Illuminate\Http\Request;

class StudentAnswerController extends Controller
{
   
    public function index()
{
    $homeworks = Homework::with('question')->get();

    
    return view('students.studentanswer.index', compact('homeworks'));
}


public function create(Request $request)
{
    $homeworkId = $request->input('homework_id');
    $homework = Homework::findOrFail($homeworkId);

    return view('students.studentanswer.create', compact('homework'));
}


public function store(Request $request)
{
    
    $validatedData = $request->validate([
        'homework_id' => 'required|exists:homeworks,id',
        'student_id' => 'required|exists:students,id',
        'answers' => 'required|array',
        'answers.*.question_id' => 'required|exists:question,id',
        'answers.*.answer' => 'required',
    ]);

    $totalMarks = 0;  
    $earnedMarks = 0; 

    foreach ($validatedData['answers'] as $answerData) {
        $question = Question::findOrFail($answerData['question_id']);

       
        $questionMark = $question->marks ?? 1; 
        $totalMarks += $questionMark;

        $correctAnswers = json_decode($question->correct_answers, true);

       
        $submittedAnswer = is_array($answerData['answer']) 
            ? implode(',', array_map('trim', $answerData['answer'])) 
            : trim($answerData['answer']);

       
        $isCorrect = is_array($correctAnswers) 
            ? in_array($submittedAnswer, array_map('trim', $correctAnswers)) 
            : trim($correctAnswers) == $submittedAnswer;

        if ($isCorrect) {
            $earnedMarks += $questionMark;
        }

        StudentAnswer::create([
            'homework_id' => $validatedData['homework_id'],
            'student_id' => $validatedData['student_id'],
            'question_id' => $answerData['question_id'],
            'answer' => $submittedAnswer,
            'is_correct' => $isCorrect,
        ]);
    }

   
    session(['earnedMarks' => $earnedMarks, 'totalMarks' => $totalMarks]);

    
    return redirect()->route('students.studentanswer.result')
        ->with('success', "Your solution has been submitted! Your result :$earnedMarks / $totalMarks.");
}
  
    public function show($id)
    {
        $studentAnswer = StudentAnswer::findOrFail($id);
        return view('students.studentanswer.show', compact('studentAnswer'));
    }

   
   
   

    public function result()
    {
        
  return view('students.studentanswer.result');
        }
    

}