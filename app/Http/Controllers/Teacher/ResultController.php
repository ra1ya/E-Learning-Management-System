<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Result;
use App\Models\Students;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index(): View
    {
        $results = Result::with(['student', 'courses'])->latest()->get();

        return view('teacher.results.index', compact('results'));
    }

    public function create(): View
    {
        $students = Students::pluck('name', 'id');
        $courses = Courses::pluck('name', 'id');

        return view('teacher.results.create', compact('students', 'courses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateResult($request);
        Result::create($validated);

        return redirect()->route('teacher.results.index')->with('flash_message', 'Result added successfully.');
    }

    public function show(string $id): View
    {
        return view('teacher.results.show', ['results' => Result::with(['student', 'courses'])->findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        return view('teacher.results.edit', ['results' => Result::findOrFail($id)]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $result = Result::findOrFail($id);
        $result->update($this->validateResult($request));

        return redirect()->route('teacher.results.index')->with('flash_message', 'Result updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Result::findOrFail($id)->delete();

        return redirect()->route('teacher.results.index')->with('flash_message', 'Result deleted successfully.');
    }

    private function validateResult(Request $request): array
    {
        return $request->validate([
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'MonthlyTestone' => ['nullable', 'numeric', 'min:0'],
            'MonthlyTestwo' => ['nullable', 'numeric', 'min:0'],
            'final' => ['nullable', 'numeric', 'min:0'],
            'homeworkone' => ['nullable', 'numeric', 'min:0'],
            'homeworktwo' => ['nullable', 'numeric', 'min:0'],
            'total_marks' => ['nullable', 'numeric', 'min:0'],
        ]);
    }
}
