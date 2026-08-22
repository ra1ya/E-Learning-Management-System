<?php

namespace App\Http\Controllers\Students\Auth;

use App\Http\Controllers\Controller;
use App\Models\Students;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('students.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    { 
   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Students::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile' => ['required'],
            'address' => ['required'],

        ]);

        $students = Students::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'address'=>$request->address,
        ]);

        event(new Registered($students));

        Auth::guard('students')->login($students);

        return redirect(route('students.dashboard', absolute: false));
    }
}
