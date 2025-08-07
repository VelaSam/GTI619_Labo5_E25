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
            'password_min_length' => ['required', 'integer', 'min:1', 'max:50'],
            'password_require_lowercase' => ['boolean'],
            'password_require_uppercase' => ['boolean'],
            'password_require_digit' => ['boolean'],
            'password_require_special' => ['boolean'],
        ]);

        \App\Models\User::query()->update([
            'password_expires_in_days' => $validated['interval_minutes'],
            'password_changed_at' => now(),
            'password_history_limit' => $validated['password_history_limit'],
            'password_min_length' => $validated['password_min_length'],
            'password_require_lowercase' => $validated['password_require_lowercase'] ?? false,
            'password_require_uppercase' => $validated['password_require_uppercase'] ?? false,
            'password_require_digit' => $validated['password_require_digit'] ?? false,
            'password_require_special' => $validated['password_require_special'] ?? false,
        ]);

        return redirect('/adminOptions')->with('success', 'Password settings updated');
    }
}
