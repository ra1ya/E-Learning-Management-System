<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Testanswer;

class TestanswerController extends Controller
{
    public function index()
    {
        $testanswer = Testanswer::with(['student', 'test', 'testques'])
            ->get()
            ->groupBy(fn ($answer) => $answer->test_id . '_' . $answer->student_id)
            ->map(function ($group) {
                $earnedMarks = $group->sum(function ($answer) {
                    $marks = (float) ($answer->testques->marks ?? 0);
                    return $answer->is_correct ? $marks : 0;
                });

                $maxMarks = $group->sum(fn ($answer) => (float) ($answer->testques->marks ?? 0));

                return [
                    'student' => $group->first()->student,
                    'test' => $group->first()->test,
                    'total_marks' => $earnedMarks,
                    'max_marks' => $maxMarks,
                ];
            });

        return view('teacher.testanswer.index', compact('testanswer'));
    }

    public function show(string $id)
    {
        $testanswer = Testanswer::with(['student', 'test', 'testques'])->findOrFail($id);

        return view('teacher.testanswer.show', compact('testanswer'));
    }
}
