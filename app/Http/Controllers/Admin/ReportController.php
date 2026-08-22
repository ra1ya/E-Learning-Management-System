<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function report1(int $pid)
    {
        $payment = Payments::with(['enrollment.batch', 'enrollment.student'])->findOrFail($pid);

        $batchName = e($payment->enrollment?->batch?->name ?? 'N/A');
        $studentName = e($payment->enrollment?->student?->name ?? 'Unknown');
        $enrollNo = e($payment->enrollment?->enroll_no ?? 'N/A');
        $paidDate = e((string) $payment->paid_date);
        $amount = e((string) $payment->amount);
        $printedBy = e(Auth::guard('admin')->user()?->name ?? 'Admin');
        $printedDate = e(date('Y-m-d'));

        $html = <<<HTML
        <div style="margin:20px;padding:20px;font-family:sans-serif">
            <h1 style="text-align:center">Payment Receipt</h1>
            <hr>
            <p>Receipt No: <strong>{$pid}</strong></p>
            <p>Date: <strong>{$paidDate}</strong></p>
            <p>Enrollment No: <strong>{$enrollNo}</strong></p>
            <p>Student Name: <strong>{$studentName}</strong></p>
            <hr>
            <table style="width:100%;border-collapse:collapse">
                <tr><th style="text-align:left">Description</th><th style="text-align:left">Amount</th></tr>
                <tr><td>{$batchName}</td><td>{$amount}</td></tr>
            </table>
            <hr>
            <p>Printed by: <strong>{$printedBy}</strong></p>
            <p>Printed Date: <strong>{$printedDate}</strong></p>
        </div>
        HTML;

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);

        return $pdf->stream("payment-receipt-{$pid}.pdf");
    }
}
