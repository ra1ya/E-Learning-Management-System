<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Test;
use App\Models\Testques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        $test = Test::with('courses')->latest()->get();

        return view('teacher.test.index', compact('test'));
    }

    public function create()
    {
        $courses = Courses::pluck('name', 'id');

        return view('teacher.test.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'deadline' => ['required', 'date'],
            'description' => ['required', 'string'],
            'testques' => ['required', 'array', 'min:1'],
            'testques.*.text' => ['required', 'string', 'max:255'],
            'testques.*.type' => ['required', 'string', 'max:50'],
            'testques.*.options' => ['nullable', 'array'],
            'testques.*.correct_answers' => ['nullable', 'array'],
            'testques.*.marks' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated) {
            $test = Test::create([
                'title' => $validated['title'],
                'course_id' => $validated['course_id'],
                'deadline' => $validated['deadline'],
                'description' => $validated['description'],
            ]);

            foreach ($validated['testques'] as $questionData) {
                Testques::create([
                    'test_id' => $test->id,
                    'text' => $questionData['text'],
                    'type' => $questionData['type'],
                    'options' => isset($questionData['options']) ? json_encode($questionData['options']) : null,
                    'correct_answers' => isset($questionData['correct_answers']) ? json_encode($questionData['correct_answers']) : null,
                    'marks' => $questionData['marks'],
                ]);
            }
        });

        return redirect()->route('teacher.test.index')->with('success', 'Test created successfully.');
    }

    public function show(string $id)
    {
        $test = Test::with('testques')->findOrFail($id);

        return view('teacher.test.show', compact('test'));
    }

    public function edit(string $id)
    {
        $test = Test::findOrFail($id);

        return view('teacher.test.edit', compact('test'));
    }

    public function update(Request $request, string $id)
    {
        $test = Test::findOrFail($id);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'deadline' => ['required', 'date'],
            'description' => ['required', 'string'],
        ]);

        $test->update($validated);

        return redirect()->route('teacher.test.index')->with('flash_message', 'Test updated successfully.');
    }

    public function destroy(string $id)
    {
        Test::findOrFail($id)->delete();

        return redirect()->route('teacher.test.index')->with('flash_message', 'Test deleted successfully.');
    }
}
