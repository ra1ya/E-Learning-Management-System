<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeachersController extends Controller
{
    public function index(): View
    {
        return view('admin.teacher.index', ['teachers' => Teacher::query()->latest()->get()]);
    }

    public function create(): View
    {
        return view('admin.teacher.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:teacher,email'],
            'password' => ['required', 'string', 'min:8'],
            'mobile' => ['required', 'string', 'max:30'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        Teacher::create($validated);

        return redirect()->route('admin.teacher.index')->with('flash_message', 'Teacher added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.teacher.show', ['teachers' => Teacher::findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        return view('admin.teacher.edit', ['teachers' => Teacher::findOrFail($id)]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $teacher = Teacher::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('teacher', 'email')->ignore($teacher->id)],
            'mobile' => ['required', 'string', 'max:30'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        $teacher->update($validated);

        return redirect()->route('admin.teacher.index')->with('flash_message', 'Teacher updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Teacher::findOrFail($id)->delete();

        return redirect()->route('admin.teacher.index')->with('flash_message', 'Teacher deleted successfully.');
    }
}
