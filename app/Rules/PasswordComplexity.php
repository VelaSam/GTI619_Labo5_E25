<?php

namespace App\Rules;

use App\Models\SecuritySetting;
use Illuminate\Contracts\Validation\Rule;

class PasswordComplexity implements Rule
{
    public function passes($attribute, $value)
    {
        $minLength = (int) SecuritySetting::getValue('password_min_length', 8);
        $requireLowercase = (bool) SecuritySetting::getValue('password_require_lowercase', true);
        $requireUppercase = (bool) SecuritySetting::getValue('password_require_uppercase', true);
        $requireDigit = (bool) SecuritySetting::getValue('password_require_digit', true);
        $requireSpecial = (bool) SecuritySetting::getValue('password_require_special', true);

        if (strlen($value) < $minLength)
            return false;

        if ($requireLowercase && !preg_match('/[a-z]/', $value))
            return false;

        if ($requireUppercase && !preg_match('/[A-Z]/', $value))
            return false;

        if ($requireDigit && !preg_match('/[0-9]/', $value))
            return false;

        if ($requireSpecial && !preg_match('/[^A-Za-z0-9]/', $value))
            return false;

        return true;
    }

    public function message()
    {
        $minLength = SecuritySetting::getValue('password_min_length', 8);
        $requirements = [];

        if (SecuritySetting::getValue('password_require_lowercase', true)) {
            $requirements[] = 'une minuscule';
        }
        if (SecuritySetting::getValue('password_require_uppercase', true)) {
            $requirements[] = 'une majuscule';
        }
        if (SecuritySetting::getValue('password_require_digit', true)) {
            $requirements[] = 'un chiffre';
        }
        if (SecuritySetting::getValue('password_require_special', true)) {
            $requirements[] = 'un caractère spécial';
        }

        $requirementsText = implode(', ', $requirements);
        return "Le mot de passe doit contenir au moins {$minLength} caractères, {$requirementsText}.";
    }
}