<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Homework;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeworkController extends Controller
{
    public function index()
    {
        $homework = Homework::with('courses')->latest()->get();

        return view('teacher.homework.index', compact('homework'));
    }

    public function create()
    {
        $courses = Courses::pluck('name', 'id');

        return view('teacher.homework.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'deadline' => ['required', 'date'],
            'description' => ['required', 'string'],
            'question' => ['required', 'array', 'min:1'],
            'question.*.text' => ['required', 'string', 'max:255'],
            'question.*.type' => ['required', 'string', 'max:50'],
            'question.*.options' => ['nullable', 'array'],
            'question.*.correct_answers' => ['nullable', 'array'],
            'question.*.marks' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated) {
            $homework = Homework::create([
                'title' => $validated['title'],
                'course_id' => $validated['course_id'],
                'deadline' => $validated['deadline'],
                'description' => $validated['description'],
            ]);

            foreach ($validated['question'] as $questionData) {
                Question::create([
                    'homework_id' => $homework->id,
                    'text' => $questionData['text'],
                    'type' => $questionData['type'],
                    'options' => isset($questionData['options']) ? json_encode($questionData['options']) : null,
                    'correct_answers' => isset($questionData['correct_answers']) ? json_encode($questionData['correct_answers']) : null,
                    'marks' => $questionData['marks'],
                ]);
            }
        });

        return redirect()->route('teacher.homework.index')->with('success', 'Homework created successfully.');
    }

    public function show(string $id)
    {
        $homework = Homework::with('question')->findOrFail($id);

        return view('teacher.homework.show', compact('homework'));
    }

    public function edit(string $id)
    {
        $homework = Homework::findOrFail($id);

        return view('teacher.homework.edit', compact('homework'));
    }

    public function update(Request $request, string $id)
    {
        $homework = Homework::findOrFail($id);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'deadline' => ['required', 'date'],
            'description' => ['required', 'string'],
        ]);

        $homework->update($validated);

        return redirect()->route('teacher.homework.index')->with('flash_message', 'Homework updated successfully.');
    }

    public function destroy(string $id)
    {
        Homework::findOrFail($id)->delete();

        return redirect()->route('teacher.homework.index')->with('flash_message', 'Homework deleted successfully.');
    }
}
