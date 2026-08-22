<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\Payments;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payments::all();
        return view ('admin.payments.index')->with('payments', $payments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enrollment= Enrollment::pluck('enroll_no','id');
        return view('admin.payments.create',compact('enrollment')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Payments::create($input);
        return redirect('admin/payments')->with('flash_message', 'Payments Addedd!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payments = Payments::find($id);
        return view('admin.payments.show')->with('payments', $payments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $payments = Payments::find($id);
        $enrollment= Enrollment::pluck('enroll_no','id');
        return view('admin.payments.edit',compact('payments','enrollment'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payments = Payments::find($id);
        $input = $request->all();
        $payments->update($input);
        return redirect('admin/payments')->with('flash_message', 'payments Updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payments::destroy($id);
        return redirect('admin/payments')->with('flash_message', 'payments deleted!'); 
    }
}
