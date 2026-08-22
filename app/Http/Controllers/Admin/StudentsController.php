<?php

namespace App\Http\Controllers\Admin;
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
        return view('admin.student.index')->with('students', $students);
    }
    
 
    public function create(): View
    {
        return view('admin.student.create');
    }
  
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Students::create($input);
        return redirect('admin/student')->with('flash_message', 'Student Addedd!');
    }
    
    public function show(string $id): View
    {
        $students = Students::find($id);
        return view('admin.student.show')->with('students', $students);
    }
    
    public function edit(string $id): View
    { 
        $students = Students::find($id);
        return view('admin.student.edit')->with('students', $students);
    }
    public function update(Request $request, string $id): RedirectResponse
    { 
        $students = Students::find($id);
        $input = $request->all();
        $students->update($input);
        return redirect('admin/student')->with('flash_message', 'student Updated!');  
      
    }

    
    public function destroy(string $id): RedirectResponse
    {
        Students::destroy($id);
        return redirect('admin/student')->with('flash_message', 'Student deleted!'); 
    }
}
