<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Teachers;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TeachersController extends Controller
{
    public function index():View
    {
        $teachers = Teacher::all();
        return view ('admin.teacher.index')->with('teachers', $teachers);
    }
    
 
    public function create():View
    {
        return view('admin.teacher.create');
    }

    public function store(Request $request):RedirectResponse
    {
        $input = $request->all();
        Teacher::create($input);
        return redirect('admin/teacher')->with('flash_message', 'Teachers Addedd!');
    }

    public function show(string $id): View
    {
        $teachers = Teacher::find($id);
        return view('admin.teacher.show')->with('teachers', $teachers);
    }

    public function edit(string $id): View
    {
        $teachers = Teacher::find($id);
        return view('admin.teacher.edit')->with('teachers', $teachers);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $teachers = Teacher::find($id);
        $input = $request->all();
        $teachers->update($input);
        return redirect('admin/teacher')->with('flash_message', 'teacher Updated!');  
    }

    public function destroy(string $id): RedirectResponse
    {
        Teacher::destroy($id);
        return redirect('admin/teacher')->with('flash_message', 'teacher deleted!'); 
    }
}
