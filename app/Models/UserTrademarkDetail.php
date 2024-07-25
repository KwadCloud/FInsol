<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserTrademarkDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_trademark_details';

    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_unique_id',
        'trademark_number',
        'name_of_business',
        'name_of_trademark',
        'trademark_email',
        'registration_type',
        'trademark_mobile',
        'trademark_type',
        'trademark_pan_img',
        'trademark_firm_img',
        'trademark_rent_elec_img',
        'trademark_declaration_img',
        'trademark_kyc_img',
        'trademark_certificate_img',
        'trademark_oth_aadhar_img',
        'trademark_udamy_img',
        'trademark_logo_img',
        'trademark_aff_img',
        'trademark_oth_photo_img',
        'trademark_oth_spaceman_img',
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
