<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
       
       
    
        
        $studentId = auth('students')->id();
    
        $results = Result::where('student_id', $studentId)->get();
    
        return view('students.results.index', compact('results'));
    }
     

}
