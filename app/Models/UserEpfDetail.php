<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserEpfDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_epf_details';

    protected $fillable = [
        'user_id',
        'epf_email',
        'payment_status',
        'payment_unique_id',
        'name_of_epf',
        'epf_number',
        'epf_mobile',
        'epf_type',
        'epf_pan_img',
        'epf_firm_img',
        'epf_rent_elec_img',
        'epf_declaration_img',
        'epf_kyc_img',
        'epf_certificate_img',
        'epf_oth_aadhar_img',
        'epf_oth_pan_img',
        'epf_oth_photo_img',
        'epf_oth_spaceman_img',
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
