<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserPanDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_pan_details';

    protected $fillable = [
        'user_id',
        'email_id',
        'registration_type',
        'name_of_pan',
        'pan_number',
        'mobile_number',
        'payment_status',
        'payment_unique_id',
        'pan_aadhar_voterid_passport_img',
        'pan_driving_license',
        'pan_your_photo',
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
