<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserUdamyDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_udamy_details';

    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_unique_id',
        'name_of_udamy',
        'udamy_number',
        'udamy_email',
        'registration_type',
        'udamy_mobile',
        'docs_img',
        'pan_img',
        'aadhar_img',
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
