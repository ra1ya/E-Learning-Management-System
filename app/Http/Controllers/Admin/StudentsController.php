<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentsController extends Controller
{
    public function index(): View
    {
        return view('admin.student.index', ['students' => Students::query()->latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.student.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'password' => ['required', 'string', 'min:8'],
            'mobile' => ['required', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        Students::create($validated);

        return redirect()->route('admin.student.index')->with('flash_message', 'Student added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.student.show', ['students' => Students::findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        return view('admin.student.edit', ['students' => Students::findOrFail($id)]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $student = Students::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('students', 'email')->ignore($student->id)],
            'mobile' => ['required', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $student->update($validated);

        return redirect()->route('admin.student.index')->with('flash_message', 'Student updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Students::findOrFail($id)->delete();

        return redirect()->route('admin.student.index')->with('flash_message', 'Student deleted successfully.');
    }
}
