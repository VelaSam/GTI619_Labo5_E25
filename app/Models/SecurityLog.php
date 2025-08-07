<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityLog extends Model
{
    protected $fillable = [
        'user_id',
        'event_type',
        'description',
        'success'
    ];

    protected $casts = [
        'success' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function logLoginAttempt($email, $success)
    {
        $user = User::where('email', $email)->first();

        return self::create([
            'user_id' => $user ? $user->id : null,
            'event_type' => 'login_attempt',
            'description' => $success ? 'Successful login' : 'Failed login attempt',
            'success' => $success
        ]);
    }

    public static function logPasswordChange($userId, $success)
    {
        return self::create([
            'user_id' => $userId,
            'event_type' => 'password_change',
            'description' => $success ? 'Password changed successfully' : 'Password change failed',
            'success' => $success
        ]);
    }
}