<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserTrademarkSignatory extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_trademark_signatory';

    protected $fillable = [
        'user_id',
        'user_trademark_id',
        'trademark_sign_mobile',
        'trademark_sign_email',
        'trademark_sign_pan_img',
        'trademark_sign_aadhar_img',
        'trademark_sign_photo_img',
        'trademark_sign_spaceman_img',
        'trademark_sign_declare_img',
        'trademark_signaff_img',
        'docs_img',
    ];

}
