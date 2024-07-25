<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PaymentValue extends Authenticatable
{
    use Notifiable;

    protected $table = 'payment_values';

    protected $fillable = [
        'form_type',
        'form',
        'value',
    ];
}
