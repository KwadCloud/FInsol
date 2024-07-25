<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CopyOfReturns extends Authenticatable
{
    use Notifiable;

    protected $table = 'copy_of_returns';

    protected $fillable = [
        'user_id',
        'user_gst_id',
        'trade_name',
        'gst_number',
        'form_type',
        'year',
        'month',
        'quarter',
        'documents',
    ];

}
