<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batches;
use App\Models\Courses;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BatchesController extends Controller
{
    public function index(): View
    {
        return view('admin.batches.index', [
            'batches' => Batches::with('course')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.batches.create', [
            'courses' => Courses::pluck('name', 'id'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Batches::create($this->validatedData($request));

        return redirect()->route('admin.batches.index')
            ->with('flash_message', 'Batch added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.batches.show', [
            'batches' => Batches::with('course')->findOrFail($id),
        ]);
    }

    public function edit(string $id): View
    {
        return view('admin.batches.edit', [
            'batches' => Batches::findOrFail($id),
            'courses' => Courses::pluck('name', 'id'),
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $batch = Batches::findOrFail($id);
        $batch->update($this->validatedData($request));

        return redirect()->route('admin.batches.index')
            ->with('flash_message', 'Batch updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Batches::findOrFail($id)->delete();

        return redirect()->route('admin.batches.index')
            ->with('flash_message', 'Batch deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'start_date' => ['required', 'date'],
        ]);
    }
}
