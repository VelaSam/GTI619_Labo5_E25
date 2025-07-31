<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordComplexity implements Rule
{
    public function passes($attribute, $value)
    {
        if (strlen($value) < 8)
            return false;

        if (!preg_match('/[a-z]/', $value))
            return false;

        if (!preg_match('/[A-Z]/', $value))
            return false;

        if (!preg_match('/[0-9]/', $value))
            return false;

        if (!preg_match('/[^A-Za-z0-9]/', $value))
            return false;

        return true;
    }

    public function message()
    {
        return 'Le mot de passe doit contenir au moins 8 caractères, une minuscule, une majuscule, un chiffre et un caractère spéciale';
    }
}