<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Batches;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index():View
    {
        $courses = Courses::all();
        return view ('teacher.course.index')->with('courses', $courses);
    }
 
    public function create(): View
    {
        return view('teacher.course.create');
    }
  
   
    public function store(Request $request): RedirectResponse
{
   
    $request->validate([
        'name' => 'required|string|max:255',
        'syllabus' => 'required|string',
        'duration' => 'required|string', 
        'video_link' => 'nullable|url',
        'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
    ]);
    
    if ($request->hasFile('pdf_file')) {
        
        $pdfPath = $request->file('pdf_file')->store('public/pdfs');
        $validated['pdf_file'] = $pdfPath;
    }
  
    Courses::create([
        'name' => $request->name,
        'syllabus' => $request->syllabus,
        'duration' => $request->duration, 
        'video_link' => $request->video_link,
        'pdf_file'=>$request->pdf_file,
    ]);

    return redirect('teacher/course')->with('flash_message', 'Course Added!');
}

    public function show(string $id): View
    {
        $courses = Courses::find($id);
        return view('teacher.course.show')->with('courses', $courses);
    }
    
    public function edit(string $id): View
    {
        $courses = Courses::find($id);
        return view('teacher.course.edit')->with('courses', $courses);
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        $courses = Courses::find($id);
        $input = $request->all();
        $courses->update($input);
        return redirect('teacher/course')->with('flash_message', 'Course Updated!');  
    }
    
    public function destroy(string $id): RedirectResponse
    {
        Courses::destroy($id);
        return redirect('teacher/course')->with('flash_message', 'Course deleted!'); 
    }
}
