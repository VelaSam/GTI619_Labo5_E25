<?php

namespace App\Http\Controllers;

use App\Models\SecuritySetting;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:view_page_admin');
    }

    public function index()
    {
        $settings = [
            'password_min_length' => SecuritySetting::getValue('password_min_length', 8),
            'password_require_lowercase' => SecuritySetting::getValue('password_require_lowercase', true),
            'password_require_uppercase' => SecuritySetting::getValue('password_require_uppercase', true),
            'password_require_digit' => SecuritySetting::getValue('password_require_digit', true),
            'password_require_special' => SecuritySetting::getValue('password_require_special', true),
        ];

        return view('security.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'password_min_length' => 'required|integer|min:6|max:50',
            'password_require_lowercase' => 'boolean',
            'password_require_uppercase' => 'boolean',
            'password_require_digit' => 'boolean',
            'password_require_special' => 'boolean',
        ]);

        SecuritySetting::setValue('password_min_length', $request->password_min_length);
        SecuritySetting::setValue('password_require_lowercase', $request->has('password_require_lowercase'));
        SecuritySetting::setValue('password_require_uppercase', $request->has('password_require_uppercase'));
        SecuritySetting::setValue('password_require_digit', $request->has('password_require_digit'));
        SecuritySetting::setValue('password_require_special', $request->has('password_require_special'));

        return redirect()->route('security.index')->with('success', 'Paramètres de sécurité mis à jour avec succès.');
    }
}