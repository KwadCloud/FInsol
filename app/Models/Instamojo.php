<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Instamojo extends Authenticatable
{
    use Notifiable;

    protected $table = 'instamojo_payment_report';

    protected $fillable = [
        'staus',
        'user_id',
        'type',
        'amount',
        'payment_id',
        'payment_request_id',
        'type',
    ];

}
