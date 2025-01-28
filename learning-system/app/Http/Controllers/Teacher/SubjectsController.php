<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\Subjects;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    
    public function index(): View
    {
        $subjects = Subjects::all();
        return view('teacher.subjects.index')->with('subjects', $subjects);
    }
    
 
    public function create(): View
    {
        return view('teacher.subjects.create');
    }
  
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Subjects::create($input);
        return redirect('teacher/subjects')->with('flash_message', 'subjects Addedd!');
    }
    
    public function show(string $id): View
    {
        $subjects = Subjects::find($id);
        return view('teacher.subjects.show')->with('subjects', $subjects);
    }
    
    public function edit(string $id): View
    { 
        $subjects = Subjects::find($id);
        return view('teacher.subjects.edit')->with('subjects', $subjects);
    }
    public function update(Request $request, string $id): RedirectResponse
    { 
        $subjects = Subjects::find($id);
        $input = $request->all();
        $subjects->update($input);
        return redirect('teacher/subjects')->with('flash_message', 'subjects Updated!');  
     
    }

    
    public function destroy(string $id): RedirectResponse
    {
        Subjects::destroy($id);
        return redirect('teacher/subjects')->with('flash_message', 'Subjects deleted!'); 
    }
}
