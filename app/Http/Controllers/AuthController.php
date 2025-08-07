<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\SecurityLog;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.resetPass');

    }

    public function reset(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = \App\Models\User::where('email', $validated['email'])->first();

        $complexityErrors = \App\Models\User::validatePasswordComplexity($validated['password']);
        if (!empty($complexityErrors)) {
            return back()->withErrors(['password' => implode(' ', $complexityErrors)]);
        }

        if (\App\Models\PasswordHistory::isPasswordInHistory($user->id, $validated['password'])) {
            SecurityLog::logPasswordChange($user->id, false);

            return back()->withErrors([
                'password' => 'You cannot reuse one of your previous passwords.',
            ]);
        }

        try {
            $user->password = Hash::make($validated['password']);
            $user->password_changed_at = now();
            $user->save();

            \App\Models\PasswordHistory::addPassword($user->id, $validated['password']);

            \App\Models\PasswordHistory::cleanupOldPasswords($user->id, $user->getPasswordHistoryLimit());

            SecurityLog::logPasswordChange($user->id, true);

            Auth::login($user);

            return redirect()->route('home')->with('success', 'Password reset and logged in successfully.');
        } catch (\Exception $e) {
            SecurityLog::logPasswordChange($user->id, false);

            return back()->withErrors([
                'password' => 'An error occurred while changing your password.',
            ]);
        }
    }

}
