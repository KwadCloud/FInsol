<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserPartner extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_partners';

    protected $fillable = [
        'user_id',
        'user_gst_id',
        'partner_mobile',
        'partner_email',
        'p_pancard_img',
        'p_aadharcard_img',
        'p_voterid_or_passport_img',
        'p_drivinglicence_img',
        'p_userphoto_img',
        'docs_img',
    ];

}
