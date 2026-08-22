<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('teacher.question.index', [
            'question' => Question::query()->with('homework')->latest()->get(),
        ]);
    }

    public function show(string $id): View
    {
        return view('teacher.question.show', [
            'question' => Question::with('homework')->findOrFail($id),
        ]);
    }

    public function edit(string $id): View
    {
        return view('teacher.question.edit', [
            'question' => Question::findOrFail($id),
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $question = Question::findOrFail($id);

        $validated = $request->validate([
            'text' => ['required', 'string', 'max:1000'],
            'type' => ['required', Rule::in(['text', 'radio', 'checkbox'])],
            'options' => ['nullable', 'array'],
            'options.*' => ['nullable', 'string', 'max:255'],
            'correct_answers' => ['sometimes', 'nullable', 'array'],
            'correct_answers.*' => ['nullable', 'string', 'max:255'],
            'marks' => ['sometimes', 'nullable', 'integer', 'min:1'],
        ]);

        if (array_key_exists('options', $validated)) {
            $options = array_values(array_filter(
                $validated['options'] ?? [],
                fn ($value) => trim((string) $value) !== ''
            ));
            $validated['options'] = $options === [] ? null : json_encode($options);
        }

        if (array_key_exists('correct_answers', $validated)) {
            $answers = array_values(array_filter(
                $validated['correct_answers'] ?? [],
                fn ($value) => trim((string) $value) !== ''
            ));
            $validated['correct_answers'] = $answers === [] ? null : json_encode($answers);
        }

        $question->update($validated);

        return redirect()->route('teacher.question.index')
            ->with('flash_message', 'Question updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Question::findOrFail($id)->delete();

        return redirect()->route('teacher.question.index')
            ->with('flash_message', 'Question deleted successfully.');
    }
}
