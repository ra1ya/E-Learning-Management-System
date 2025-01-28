<?php

namespace App\Http\Controllers\Teacher;;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Test;
use App\Models\Testques;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $test = Test::all();
        return view('teacher.test.index')->with('test', $test);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Courses::pluck('name', 'id');
        return view('teacher.test.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|integer',
            'deadline' => 'required|date',
            'description' => 'required|string',
            'testques.*.text' => 'required|string',
            'testques.*.type' => 'required|string',
            'testques.*.marks' => 'required|integer|min:1',
        ]);
    
        $test = Test::create([
            'title' => $validatedData['title'],
            'course_id' => $validatedData['course_id'],
            'deadline' => $validatedData['deadline'],
            'description' => $validatedData['description'],
        ]);
    
        if (!empty($request->testques)) {
            foreach ($request->testques as $questionData) {
                Testques::create([
                    'test_id' => $test->id,
                    'text' => $questionData['text'],
                    'type' => $questionData['type'],
                    'options' => isset($questionData['options']) ? json_encode($questionData['options']) : null,
                    'correct_answers' => isset($questionData['correct_answers']) ? json_encode($questionData['correct_answers']) : null,
                    'marks' => $questionData['marks'],
                ]);
            }
        }
    
        return redirect()->route('teacher.test.index')->with('success', 'تم إنشاء الاختبار والأسئلة بنجاح.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $test = Test::with('testques')->findOrFail($id);
        return view('teacher.test.show', compact('test'));
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $test = Test::find($id);
        return view('teacher.test.edit')->with('test', $test);
    }

    public function update(Request $request, string $id)
    {
        $test = Test::find($id);
        $input = $request->all();
        $test->update($input);
        return redirect('teacher/test')->with('flash_message', 'Test Updated!');
    }

    public function destroy(string $id)
    {
        Test::destroy($id);
        return redirect('teacher/test')->with('flash_message', 'Test deleted!');
    }
}
