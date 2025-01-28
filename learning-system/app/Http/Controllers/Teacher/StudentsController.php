<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    
    public function index(): View
    {
        $students = Students::all();
        return view('teacher.student.index')->with('students', $students);
    }
    
 
    public function create(): View
    {
        return view('teacher.student.create');
    }
  
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Students::create($input);
        return redirect('teacher/student')->with('flash_message', 'Student Addedd!');
    }
    
    public function show(string $id): View
    {
        $students = Students::find($id);
        return view('teacher.student.show')->with('students', $students);
    }
    
    public function edit(string $id): View
    { 
        $students = Students::find($id);
        return view('teacher.student.edit')->with('students', $students);
    }
    public function update(Request $request, string $id): RedirectResponse
    { 
        $students = Students::find($id);
        $input = $request->all();
        $students->update($input);
        return redirect('teacher/student')->with('flash_message', 'student Updated!');  
    
    }

    
    public function destroy(string $id): RedirectResponse
    {
        Students::destroy($id);
        return redirect('teacher/student')->with('flash_message', 'Student deleted!'); 
    }
}
