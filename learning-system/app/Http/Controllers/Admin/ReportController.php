<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\Payments;

use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
public function report1($pid)
{


    $payments = Payments::find($pid);

    if (!$payments || !$payments->enrollment || !$payments->enrollment->batch) {
        return redirect()->back()->withErrors('البيانات المطلوبة غير متوفرة.');
    }
    
    $batchName = $payments->enrollment->batch->name ?? 'N/A';
    $studentName = $payments->enrollment->student->name ?? 'Unknown';
    $printedBy = Auth::check() ? Auth::user()->name : 'Guest';
    
    $print = "<div style='margin:20px;padding:20px;'>";
    $print .= "<h1 align='center'>Payment Receipt</h1>";
    $print .= "<hr/>";
    $print .= "<p>Receipt No: <b>" . $pid . "</b></p>";
    $print .= "<p>Date: <b>" . $payments->paid_date . "</b></p>";
    $print .= "<p>Enrollment No: <b>" . $payments->enrollment->enroll_no . "</b></p>";
    $print .= "<p>Student Name: <b>" . $studentName . "</b></p>";
    $print .= "<hr/>";
    $print .= "<table style='width:100%;'>";
    $print .= "<tr><td>Description</td><td>Amount</td></tr>";
    $print .= "<tr><td><h3>" . $batchName . "</h3></td><td><h3>" . $payments->amount . "</h3></td></tr>";
    $print .= "</table>";
    $print .= "<hr/>";
    $print .= "<span> Printed Date: <b>" . date('Y-m-d') . "</b></span>";
    $print .= "</div>";
    
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML($print);
    
    return $pdf->stream();
    
  


}


}

?>


