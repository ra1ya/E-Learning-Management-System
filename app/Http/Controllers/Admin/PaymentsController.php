<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Payments;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentsController extends Controller
{
    public function index(): View
    {
        $payments = Payments::with('enrollment')->latest()->get();

        return view('admin.payments.index', compact('payments'));
    }

    public function create(): View
    {
        $enrollment = Enrollment::pluck('enroll_no', 'id');

        return view('admin.payments.create', compact('enrollment'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'enrollment_id' => ['required', 'integer', 'exists:enrollment,id'],
            'paid_date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:0'],
        ]);

        Payments::create($validated);

        return redirect()->route('admin.payments.index')->with('flash_message', 'Payment added successfully.');
    }

    public function show(string $id): View
    {
        return view('admin.payments.show', ['payments' => Payments::with('enrollment')->findOrFail($id)]);
    }

    public function edit(string $id): View
    {
        $payments = Payments::findOrFail($id);
        $enrollment = Enrollment::pluck('enroll_no', 'id');

        return view('admin.payments.edit', compact('payments', 'enrollment'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $payment = Payments::findOrFail($id);
        $validated = $request->validate([
            'enrollment_id' => ['required', 'integer', 'exists:enrollment,id'],
            'paid_date' => ['required', 'date'],
            'amount' => ['required', 'numeric', 'min:0'],
        ]);

        $payment->update($validated);

        return redirect()->route('admin.payments.index')->with('flash_message', 'Payment updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Payments::findOrFail($id)->delete();

        return redirect()->route('admin.payments.index')->with('flash_message', 'Payment deleted successfully.');
    }
}
