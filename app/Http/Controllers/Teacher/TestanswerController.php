<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Testanswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestanswerController extends Controller
{
    public function index()
    {
        $testanswer = Testanswer::with(['student', 'test', 'testques'])
            ->get()
            ->groupBy(function ($answer) {
                return $answer->test_id . '_' . $answer->student_id;
            })
            ->map(function ($group) {
                
                $totalMarks = $group->sum(function ($answer) {
                    $marks = $answer->testques->marks ?? 0;
                    return $answer->is_correct && is_numeric($marks) ? (float) $marks : 0;
                });
    
                $maxMarks = $group->sum(function ($answer) {
                    return is_numeric($answer->testques->marks) ? (float) $answer->testques->marks : 0;
                });
    
               
                foreach ($group as $answer) {
                    $answer->update(['total_marks' => $totalMarks]);
                    Log::info("Updated Testanswer ID {$answer->id} with total_marks: {$totalMarks}");
                }
                
    
                return [
                    'student' => $group->first()->student,
                    'test' => $group->first()->test,
                    'total_marks' => $totalMarks,
                    'max_marks' => $maxMarks,
                ];
            });
    
        return view('teacher.testanswer.index', compact('testanswer'));
    }
    
    public function show($id)
    {
        Log::info("Attempting to fetch testanswer with ID: {$id}");
        
        $testanswer = Testanswer::with(['student', 'test', 'testques'])->find($id);
        
        if (!$testanswer) {
            Log::error("testanswer with ID {$id} not found");
            abort(404); 
        }
    
        return view('teacher.testanswer.show', compact('testanswer'));
    }
    
    
}
