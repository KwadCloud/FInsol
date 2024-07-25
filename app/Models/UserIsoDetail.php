<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserIsoDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_iso_details';

    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_unique_id',
        'email_id',
        'registration_type',
        'name_of_iso',
        'iso_number',
        'mobile_number',
        'address_proof_img',
        'aadhar_img',
        'pan_img',
        'certificate_img',
        'photo_img',
        'add_img',
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
