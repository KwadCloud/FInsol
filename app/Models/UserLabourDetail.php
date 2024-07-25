<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserLabourDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_labour_details';
 
    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_unique_id',
        'labour_number',
        'name_of_business',
        'name_of_labour',
        'labour_email',
        'registration_type',
        'labour_mobile',
        'labour_type',
        'labour_pan_img',
        'labour_firm_img',
        'labour_rent_elec_img',
        'labour_declaration_img',
        'labour_kyc_img',
        'labour_certificate_img',
        'labour_oth_aadhar_img',
        'labour_udamy_img',
        'labour_logo_img',
        'labour_aff_img',
        'labour_oth_photo_img',
        'labour_oth_spaceman_img',
        'docs_img',
        'status',
        'last_updated_by',
        'last_update_by_id',
        'additional_img',
        'approved_img',
        'raised_img',
        'admin_note',
        'user_note',
        'type'
    ];

}