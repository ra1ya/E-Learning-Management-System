<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\StudentAnswer;

class StudentAnswerController extends Controller
{
    public function index()
    {
        $studentAnswers = StudentAnswer::with(['student', 'homework', 'question'])
            ->get()
            ->groupBy(fn ($answer) => $answer->homework_id . '_' . $answer->student_id)
            ->map(function ($group) {
                $earnedMarks = $group->sum(function ($answer) {
                    $marks = (float) ($answer->question->marks ?? 0);
                    return $answer->is_correct ? $marks : 0;
                });

                $maxMarks = $group->sum(fn ($answer) => (float) ($answer->question->marks ?? 0));

                return [
                    'student' => $group->first()->student,
                    'homework' => $group->first()->homework,
                    'total_marks' => $earnedMarks,
                    'max_marks' => $maxMarks,
                ];
            });

        return view('teacher.studentanswer.index', compact('studentAnswers'));
    }

    public function show(string $id)
    {
        $studentAnswer = StudentAnswer::with(['student', 'homework', 'question'])->findOrFail($id);

        return view('teacher.studentanswer.show', compact('studentAnswer'));
    }
}
