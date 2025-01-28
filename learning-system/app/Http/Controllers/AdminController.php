<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $registrations = \App\Models\Students::where('status', 'pending')->get();
        return view('admin.admin', compact('registrations'));
    }
}
