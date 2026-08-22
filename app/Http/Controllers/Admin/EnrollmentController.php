<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batches;
use App\Models\Enrollment;
use App\Models\Students;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    public function index(): View
    {
        $enrollment = Enrollment::with(['student', 'batch'])->latest()->get();

        return view('admin.enrollment.index', compact('enrollment'));
    }

    public function create(): View
    {
        $batches = Batches::pluck('name', 'id');
        $students = Students::pluck('name', 'id');

        return view('admin.enrollment.create', compact('batches', 'students'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'enroll_no' => ['required', 'string', 'max:255', 'unique:enrollment,enroll_no'],
            'batch_id' => ['required', 'integer', 'exists:batches,id'],
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'join_date' => ['required', 'date'],
            'fee' => ['required', 'numeric', 'min:0'],
        ]);

        Enrollment::create($validated);

        return redirect()->route('admin.enrollment.index')->with('flash_message', 'Enrollment added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.enrollment.show', ['enrollment' => Enrollment::with(['student', 'batch'])->findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        $enrollment = Enrollment::findOrFail($id);
        $batches = Batches::pluck('name', 'id');
        $students = Students::pluck('name', 'id');

        return view('admin.enrollment.edit', compact('enrollment', 'batches', 'students'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $enrollment = Enrollment::findOrFail($id);
        $validated = $request->validate([
            'enroll_no' => ['required', 'string', 'max:255', Rule::unique('enrollment', 'enroll_no')->ignore($enrollment->id)],
            'batch_id' => ['required', 'integer', 'exists:batches,id'],
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'join_date' => ['required', 'date'],
            'fee' => ['required', 'numeric', 'min:0'],
        ]);

        $enrollment->update($validated);

        return redirect()->route('admin.enrollment.index')->with('flash_message', 'Enrollment updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Enrollment::findOrFail($id)->delete();

        return redirect()->route('admin.enrollment.index')->with('flash_message', 'Enrollment deleted successfully.');
    }
}
