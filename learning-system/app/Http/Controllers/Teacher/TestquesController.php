<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Testques;
use Illuminate\Http\Request;

class TestquesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testques = Testques::all();
        return view('teacher.testques.index')->with('testques', $testques);
    }
   
        public function show(string $id)
    {
        
        $testques = Testques::find($id);
        return view('teacher.testques.show')->with('testques', $testques);
    
        }
        public function edit(string $id)
    {
        $testques = Testques::find($id);
        return view('teacher.testques.edit')->with('testques', $testques);
    }

    public function update(Request $request, string $id)
    {
        $testques = Testques::find($id);
        $input = $request->all();
        $testques->update($input);
        return redirect('teacher/testques')->with('flash_message', 'Testques Updated!');
    }

    public function destroy(string $id)
    {
            Testques::destroy($id);
        return redirect('teacher/testques')->with('flash_message', 'Testques deleted!');
    }
       
}
