<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    public function index(): View
    {
        return view('teacher.course.index', ['courses' => Courses::query()->latest()->get()]);
    }

    public function create(): View
    {
        return view('teacher.course.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'syllabus' => ['required', 'string'],
            'duration' => ['required', 'string', 'max:100'],
            'video_link' => ['nullable', 'url', 'max:2048'],
            'pdf_file' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        if ($request->hasFile('pdf_file')) {
            $validated['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
        }

        Courses::create($validated);

        return redirect()->route('teacher.course.index')->with('flash_message', 'Course added successfully.');
    }

    public function show(string $id): View
    {
        return view('teacher.course.show', ['courses' => Courses::findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        return view('teacher.course.edit', ['courses' => Courses::findOrFail($id)]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $course = Courses::findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'syllabus' => ['required', 'string'],
            'duration' => ['required', 'string', 'max:100'],
            'video_link' => ['nullable', 'url', 'max:2048'],
            'pdf_file' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        if ($request->hasFile('pdf_file')) {
            if ($course->pdf_file) {
                Storage::disk('public')->delete($course->pdf_file);
            }
            $validated['pdf_file'] = $request->file('pdf_file')->store('pdfs', 'public');
        } else {
            unset($validated['pdf_file']);
        }

        $course->update($validated);

        return redirect()->route('teacher.course.index')->with('flash_message', 'Course updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $course = Courses::findOrFail($id);
        if ($course->pdf_file) {
            Storage::disk('public')->delete($course->pdf_file);
        }
        $course->delete();

        return redirect()->route('teacher.course.index')->with('flash_message', 'Course deleted successfully.');
    }
}
