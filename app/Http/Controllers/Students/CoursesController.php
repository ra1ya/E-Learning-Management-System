<?php

namespace App\Http\Controllers\Students;

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
        return view ('students.courses.index')->with('courses', $courses);
    }
 
   
  
   

    public function show(string $id): View
    {
        $courses = Courses::find($id);
        return view('students.courses.show')->with('courses', $courses);
    }
    
    
   
}
