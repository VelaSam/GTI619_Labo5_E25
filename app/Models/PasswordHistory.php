<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class PasswordHistory extends Model
{
    protected $fillable = ['user_id', 'password_hash'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function addPassword($userId, $password)
    {
        return self::create([
            'user_id' => $userId,
            'password_hash' => Hash::make($password)
        ]);
    }

    public static function isPasswordInHistory($userId, $password)
    {
        $histories = self::where('user_id', $userId)->get();

        foreach ($histories as $history) {
            if (Hash::check($password, $history->password_hash)) {
                return true;
            }
        }

        return false;
    }

    public static function cleanupOldPasswords($userId, $keepCount = 5)
    {
        $histories = self::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($histories->count() > $keepCount) {
            $toDelete = $histories->slice($keepCount);
            foreach ($toDelete as $history) {
                $history->delete();
            }
        }
    }
} 