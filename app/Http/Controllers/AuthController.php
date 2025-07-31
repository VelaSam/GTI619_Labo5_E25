<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function show(){
    return view('auth.resetPass');

    }

    public function reset(Request $request){
    $validated = $request->validate([
        'email' => ['required','string','email','exists:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);


    $user = \App\Models\User::where('email', $validated['email'])->first();
    $user->password = Hash::make($validated['password']);
    $user->save();

    return redirect()->route('login')->with('success', 'Password has been reset.');
    }
    
}
