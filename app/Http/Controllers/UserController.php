<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecurityLog;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:Administrateur,Préposé aux clients résidentiels,Préposé aux clients d\'affaire'],
        ]);

        try {
            $user = \App\Models\User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);

            $user->assignRole($validated['role']);

            \App\Models\PasswordHistory::addPassword($user->id, $validated['password']);

            SecurityLog::logPasswordChange($user->id, true);

            return redirect('/adminOptions')->with('success', 'User created.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'An error occurred while creating the user.']);
        }
    }
}
