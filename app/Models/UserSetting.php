<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserSetting extends Authenticatable
{
    use Notifiable;

    protected $table = 'user_settings';

    protected $fillable = [
        'user_id',
        'type',
        'value',
    ];

}
