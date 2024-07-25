<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class GstFormType extends Authenticatable
{
    use Notifiable;

    protected $table = 'gst_form_type';

    protected $fillable = [
        'type',
    ];

}
