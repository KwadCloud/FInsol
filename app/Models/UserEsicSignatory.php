<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserEsicSignatory extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_esic_signatory';

    protected $fillable = [
        'user_id',
        'user_esic_id',
        'esic_sign_mobile',
        'esic_sign_email',
        'esic_sign_pan_img',
        'esic_sign_aadhar_img',
        'esic_sign_photo_img',
        'esic_sign_spaceman_img',
        'esic_sign_declare_img',
        'docs_img',
    ];

}
