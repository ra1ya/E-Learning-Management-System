<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Students;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

   public function login(){
    return view('auth.login');
   }
   
   function loginPost(Request $request){
    
    $request->validate([
        "name" => "required",
        "password" => "required|min:6",
        
    ]);
    try {
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route("home"));
        }
        
        return redirect(route("login"))->with("error", "Login failed. Invalid email or password.");
    } catch (\Exception $e) {
        return redirect(route("login"))->with("error", "Error: " . $e->getMessage());
    }
    
    
   }

   function register(){
    return view('auth.register');
   }

   function registerPost(Request $request)
{
    $request->validate([
        "name" => "required",
        "email" => "required",
        "password" => "required|min:6",
        "mobile" => "required|digits:10",
        "address" => "required",
    ]);

    try {
        $student = new Students();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->mobile = $request->mobile;
        $student->address = $request->address;

        if ($student->save()) {
            return redirect(route("login"))->with("success", "Account created successfully.");
        } else {
            return redirect(route("register"))->with("error", "Failed to create account.");
        }
    } catch (\Exception $e) {
        return redirect(route("register"))->with("error", "Error: " . $e->getMessage());
    }
}


}
