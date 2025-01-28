<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Homework;
use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\Subjects;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;


class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
     public function index()
{
    $homework = Homework::with('courses')->get();
    return view('teacher.homework.index', compact('homework'));
}


    public function create()
    {
        $courses = Courses::pluck('name', 'id');
        return view('teacher.homework.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|integer',
            'deadline' => 'required|date',
            'description' => 'required|string',
            'question.*.text' => 'required|string',
            'question.*.type' => 'required|string',
            'question.*.options' => 'nullable|array',
            'question.*.correct_answers' => 'nullable|array',
            'question.*.marks' => 'required|integer|min:1',
        ]);
    
     
        $homework = Homework::create([
            'title' => $validatedData['title'],
            'course_id' => $validatedData['course_id'],
            'deadline' => $validatedData['deadline'],
            'description' => $validatedData['description'],
        ]);
    
      
        foreach ($validatedData['question'] as $questionData) {
            Question::create([
                'homework_id' => $homework->id,
                'text' => $questionData['text'],
                'type' => $questionData['type'],
                'options' => isset($questionData['options']) ? json_encode($questionData['options']) : null,
                'correct_answers' => isset($questionData['correct_answers']) ? json_encode($questionData['correct_answers']) : null,
                'marks' => $questionData['marks'],
            ]);
        }
    
        return redirect()->route('teacher.homework.index')
                         ->with('success', 'تم إنشاء الواجب والأسئلة بنجاح.');
    }
    

    public function show(string $id)
    {
        
        $homework = Homework::with('question')->findOrFail($id);
        return view('teacher.homework.show', compact('homework'));
    
   
  }

    public function edit(string $id)
    {
        $homework = Homework::find($id);
        return view('teacher.homework.edit')->with('homework', $homework);
    }

    public function update(Request $request, string $id)
    {
        $homework = Homework::find($id);
        $input = $request->all();
        $homework->update($input);
        return redirect('teacher/homework')->with('flash_message', 'Homework Updated!');
    }

    public function destroy(string $id)
    {
        Homework::destroy($id);
        return redirect('teacher/homework')->with('flash_message', 'Homework deleted!');
    }
    


    public function result($homeworkId)
    {
       
        $earnedMarks = session('earnedMarks');
        $totalMarks = session('totalMarks');
    
       
        return view('teacher.homework.result', compact('earnedMarks', 'totalMarks'));
    }
    
    private function calculateMarks($homework)
{
    $totalMarks = 0;
    $earnedMarks = 0;

    foreach ($homework->questions as $question) {
        $correctAnswers = json_decode($question->correct_answers, true);
        $studentAnswer = StudentAnswer::where([
            ['homework_id', $homework->id],
            ['question_id', $question->id],
            ['student_id', auth('students')->id()]
        ])->value('answer');

        $totalMarks += $question->marks;

        if (in_array($studentAnswer, $correctAnswers)) {
            $earnedMarks += $question->marks;
        }
    }

    return compact('totalMarks', 'earnedMarks');
}

}
