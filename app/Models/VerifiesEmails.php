<?php

namespace App\Models;

use App\User;

use App\Notifications\VerifyEmail;

trait VerifiesEmails
{
    public static function bootVerifiesEmails()
    {
        static::created(function (User $user) {
            $user->email_token = str_random(128);
            $user->save();

            $user->notify(new VerifyEmail($user));
        });
    }
}
