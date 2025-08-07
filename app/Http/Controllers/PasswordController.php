<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function reset(Request $request)
    {
        $validated = $request->validate([
            'interval_minutes' => ['required', 'integer', 'min:1'],
            'password_history_limit' => ['required', 'integer', 'min:1', 'max:20'],
        ]);

        \App\Models\User::query()->update([
            'password_expires_in_days' => $validated['interval_minutes'],
            'password_changed_at' => now(),
            'password_history_limit' => $validated['password_history_limit'],
        ]);

        return redirect('/adminOptions')->with('success', 'Password settings updated');
    }
}
