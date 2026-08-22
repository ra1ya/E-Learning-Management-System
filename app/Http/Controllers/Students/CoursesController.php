<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Enrollment;
use Illuminate\Contracts\View\View;

class CoursesController extends Controller
{
    public function index(): View
    {
        $studentId = auth('students')->id();
        $courseIds = Enrollment::with('batch')
            ->where('student_id', $studentId)
            ->get()
            ->pluck('batch.course_id')
            ->filter()
            ->unique();

        $courses = Courses::whereIn('id', $courseIds)->get();

        return view('students.courses.index', compact('courses'));
    }

    public function show(string $id): View
    {
        $studentId = auth('students')->id();
        $courseIds = Enrollment::with('batch')
            ->where('student_id', $studentId)
            ->get()
            ->pluck('batch.course_id')
            ->filter()
            ->unique();

        abort_unless($courseIds->contains((int) $id), 403);
        $courses = Courses::findOrFail($id);

        return view('students.courses.show', compact('courses'));
    }
}
