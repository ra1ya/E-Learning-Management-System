<?php

namespace App\Http\Controllers\Teacher;

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class QuestionController extends Controller
{

    public function index()
    {
        $question = Question::all();
        return view('teacher.question.index')->with('question', $question);
    }
   
        public function show(string $id)
    {
        
        $question = Question::find($id);
        return view('teacher.question.show')->with('question', $question);
    
        }
        public function edit(string $id)
    {
        $question = Question::find($id);
        return view('teacher.question.edit')->with('question', $question);
    }

    public function update(Request $request, string $id)
    {
        $question = Question::find($id);
        $input = $request->all();
        $question->update($input);
        return redirect('teacher/question')->with('flash_message', 'Question Updated!');
    }

    public function destroy(string $id)
    {
            Question::destroy($id);
        return redirect('teacher/question')->with('flash_message', 'Question deleted!');
    }
        
    
}
