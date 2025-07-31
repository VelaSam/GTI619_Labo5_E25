<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function reset(Request $request)
    {
        $validated = $request->validate([
            'interval_minutes' => ['required', 'integer', 'min:1'],
        ]);

        \App\Models\User::query()->update([
        'password_expires_in_days' => $validated['interval_minutes'],
        'password_changed_at'=> now(),
        ]);
        


        return redirect('/adminOptions')->with('success', 'Password interval updated');

    }
}
