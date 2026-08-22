<?php 
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Result;
use App\Models\StudentAnswer;
use App\Models\Students;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    
    public function index()
    {
        
      $results = Result::all();
        return view('teacher.results.index')-> with('results',$results);
    }
    

   
    public function create()
    {
        $students = Students::pluck('name','id');
        $courses=Courses::pluck('name','id');
        return view('teacher.results.create',compact('students','courses'));
    }
  
   
    public function store(Request $request): RedirectResponse
{

    $request->validate([
        'student_id' => 'required|exists:students,id',
        'course_id' => 'required|exists:courses,id',
        'MonthlyTestone' => 'required|integer',
        'MonthlyTestwo' => 'required|integer', 
        'final' => 'required', 
        'homeworkone' => 'required|integer',
        'homeworktwo' => 'required|integer',
        'total_marks' => 'required',
    ]);
    
    
 
    Result::create([
        'student_id' => $request->student_id,
        'course_id' => $request->course_id,
        'MonthlyTestone' => $request->MonthlyTestone, 
        'MonthlyTestwo' => $request->MonthlyTestwo,
        'final'=>$request->final,
        'homeworkone'=>$request->homeworkone,
        'homeworktwo'=>$request->homeworktwo,
        'total_marks' => $request->total_marks,
    ]);

    return redirect('teacher/results')->with('flash_message', 'Results Added!');
}

    public function show(string $id): View
    {
        $results = Result::find($id);
        return view('teacher.results.show')->with('results', $results);
    }
    
    public function edit(string $id): View
    {
        $results = Result::find($id);
        return view('teacher.results.edit')->with('results', $results);
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        $results = Result::find($id);
        $input = $request->all();
        $results->update($input);
        return redirect('teacher/results')->with('flash_message', 'Results Updated!');  
    }
    
    public function destroy(string $id): RedirectResponse
    {
        Result::destroy($id);
        return redirect('teacher/results')->with('flash_message', 'Results deleted!'); 
    }

}


