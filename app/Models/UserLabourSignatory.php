<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserLabourSignatory extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_labour_signatory';

    protected $fillable = [
        'user_id',
        'user_labour_id',
        'labour_sign_mobile',
        'labour_sign_email',
        'labour_sign_pan_img',
        'labour_sign_aadhar_img',
        'labour_sign_photo_img',
        'labour_sign_spaceman_img',
        'labour_sign_declare_img',
        'labour_signaff_img',
        'docs_img',
    ];

}
