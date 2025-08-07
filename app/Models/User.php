<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_history_limit',
        'password_min_length',
        'password_require_lowercase',
        'password_require_uppercase',
        'password_require_digit',
        'password_require_special',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function assignRole($role)
    {

        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }
        $this->roles()->save($role);

    }

    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }
    public function permissions()
    {
        return $this->roles->map->permissions->flatten()->pluck('name')->unique();
    }

    public function getPasswordHistoryLimit()
    {
        return $this->password_history_limit ?? 5;
    }

    public function getPasswordRequirements()
    {
        return [
            'min_length' => $this->password_min_length ?? 12,
            'require_lowercase' => $this->password_require_lowercase ?? true,
            'require_uppercase' => $this->password_require_uppercase ?? true,
            'require_digit' => $this->password_require_digit ?? true,
            'require_special' => $this->password_require_special ?? true,
        ];
    }

    public static function validatePasswordComplexity($password, $requirements = null)
    {
        if (!$requirements) {
            $user = User::first();
            $requirements = $user ? $user->getPasswordRequirements() : [
                'min_length' => 12,
                'require_lowercase' => true,
                'require_uppercase' => true,
                'require_digit' => true,
                'require_special' => true,
            ];
        }

        $errors = [];

        if (strlen($password) < $requirements['min_length']) {
            $errors[] = "Password must be at least {$requirements['min_length']} characters long.";
        }

        if ($requirements['require_lowercase'] && !preg_match('/[a-z]/', $password)) {
            $errors[] = "Password must contain at least one lowercase letter.";
        }

        if ($requirements['require_uppercase'] && !preg_match('/[A-Z]/', $password)) {
            $errors[] = "Password must contain at least one uppercase letter.";
        }

        if ($requirements['require_digit'] && !preg_match('/[0-9]/', $password)) {
            $errors[] = "Password must contain at least one digit.";
        }

        if ($requirements['require_special'] && !preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]/', $password)) {
            $errors[] = "Password must contain at least one special character.";
        }

        return $errors;
    }
}
