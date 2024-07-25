<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserPartnershipDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_partnership_details';

    protected $fillable = [
        'user_id',
        'name_of_partnership',
        'partnership_number',
        'partnership_email',
        'registration_type',
        'payment_status',
        'payment_unique_id',
        'partnership_mobile',
        'partnership_rent_elec_img',
        'partnership_kyc_img',
        'partnership_certificate_img',
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
