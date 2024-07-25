<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserPayDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_pay_details';

    protected $fillable = [
        'user_id',
        'name',
        'email_id',
        'mobile_number',
        'payment_for',
        'amount',
        'payment_status',
        'payment_unique_id',
    ];

}
