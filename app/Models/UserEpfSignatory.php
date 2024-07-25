<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserEpfSignatory extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_epf_signatory';

    protected $fillable = [
        'user_id',
        'user_epf_id',
        'epf_sign_mobile',
        'epf_sign_email',
        'epf_sign_pan_img',
        'epf_sign_aadhar_img',
        'epf_sign_photo_img',
        'epf_sign_spaceman_img',
        'epf_sign_declare_img',
        'docs_img',
    ];

}
