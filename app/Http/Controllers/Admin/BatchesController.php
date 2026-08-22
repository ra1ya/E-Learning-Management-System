<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Batches;
use App\Models\Courses;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
class BatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        $batches = Batches::all();
        return view ('admin.batches.index')->with('batches', $batches);
    }

   
    public function create():View
    {
        $courses= Courses::pluck('name','id');
        return view('admin.batches.create',compact('courses')); 
        
    }

    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|integer|exists:courses,id', 
            'start_date' => 'required|date',
        ]);
    
      
        $input = $request->only(['name', 'course_id', 'start_date']);
        $input['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
    
        
        Batches::create($input);
    
        return redirect('admin/batches')->with('flash_message', 'Batch Added!');
    
    }
    
    public function show($id):View
    {
        $batches = Batches::find($id);
        return view('admin.batches.show')->with('batches', $batches);
    }

   
    public function edit($id):View
    {
        $batches = Batches::find($id);
        return view('admin.batches.edit')->with('batches', $batches);
    }

   
    public function update(Request $request, string $id): RedirectResponse
    {
        $batches = Batches::find($id);
        $input = $request->all();
        $batches->update($input);
        return redirect('admin/batches')->with('flash_message', 'batches Updated!'); 
    }

   
    public function destroy($id)
    {
        
        Batches::destroy($id);
        return redirect('admin/batches')->with('flash_message', 'batches deleted!'); 
    }
}
