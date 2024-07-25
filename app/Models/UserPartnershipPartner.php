<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserPartnershipPartner extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_partnership_partner';

    protected $fillable = [
        'user_id',
        'user_partnership_id',
        'partner_mobile',
        'partner_email',
        'partner_pan_img',
        'partner_aadhar_img',
        'partner_photo_img',
        'partner_spaceman_img',
        'partner_declare_img',
        'partner_aff_img',
        'docs_img',
    ];

}
