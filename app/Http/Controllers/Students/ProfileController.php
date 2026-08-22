<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('students.profile.edit', ['user' => Auth::guard('students')->user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::guard('students')->user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('students', 'email')->ignore($user->id)],
        ]);
        $user->update($validated);

        return redirect()->route('students.profile.edit')->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::guard('students')->user();
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if (! Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.'], 'updatePassword');
        }
        $user->update(['password' => Hash::make($validated['password'])]);

        return back()->with('status', 'password-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::guard('students')->user();
        $request->validateWithBag('userDeletion', ['password' => ['required', 'string']]);
        if (! Hash::check((string) $request->password, $user->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.'], 'userDeletion');
        }
        Auth::guard('students')->logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
