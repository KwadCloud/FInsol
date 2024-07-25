<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserTanDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_tan_details';

    protected $fillable = [
        'user_id',
        'email_id',
        'registration_type',
        'name_of_tan',
        'tan_number',
        'mobile_number',
        'payment_status',
        'payment_unique_id',
        'tan_aadhar_voterid_passport_img',
        'tan_driving_license_img',
        'tan_your_img',
        'tan_pan_img',
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
