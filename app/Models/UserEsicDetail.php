<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserEsicDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_esic_details';

    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_unique_id',
        'esic_email',
        'name_of_esic',
        'esic_number',
        'esic_mobile',
        'esic_type',
        'esic_pan_img',
        'esic_firm_img',
        'esic_rent_elec_img',
        'esic_declaration_img',
        'esic_kyc_img',
        'esic_certificate_img',
        'esic_oth_aadhar_img',
        'esic_oth_pan_img',
        'esic_oth_photo_img',
        'esic_oth_spaceman_img',
        'docs_img',
        'status',
        'last_updated_by',
        'last_update_by_id',
        'additional_img',
        'approved_img',
        'raised_img',
        'admin_note',
        'user_note',
        'type',
    ];

}
