<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Batches;
use App\Models\Enrollment;
use App\Models\Students;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnrollmentTeacherController extends Controller
{
    public function index():View
    {
        $enrollment = Enrollment::all();
        return view ('admin.enrollment.index')->with('enrollment', $enrollment);
    }

    public function create(): View
    {
        $batches = Batches::pluck('name','id');
        $students=Students::pluck('name','id');
        return view('admin.enrollment.create',compact('batches','students'));
        
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'enroll_no' => 'required|string|max:255',
            'batch_id' => 'required|exists:batches,id',
            'student_id' => 'required|exists:students,id',
            'join_date' => 'required|date',
            'fee' => 'required|numeric',
        ]);
    
        Enrollment::create($request->all());
    
        return redirect('admin/enrollment')->with('flash_message', 'Enrollment Added!');
    }
    
    public function show(string $id): View
    {
        $enrollment = Enrollment::find($id);
        return view('admin.enrollment.show')->with('enrollment', $enrollment);
    }

    public function edit(string $id): View
    {
        $enrollment = Enrollment::find($id);
        return view('admin.enrollment.edit')->with('enrollment', $enrollment);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $enrollment = Enrollment::find($id);
        $input = $request->all();
        $enrollment->update($input);
        return redirect('admin/enrollment')->with('flash_message', 'enrollment Updated!');  
    }

    public function destroy(string $id): RedirectResponse
    {
        Enrollment::destroy($id);
        return redirect('admin/enrollment')->with('flash_message', 'Enrollment deleted!'); 
    }
}
