<?php

namespace App\Models\Certification;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserCaDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_ca_details';

    protected $fillable = [
        'user_id',
        'email_id',
        'payment_status',
        'payment_unique_id',
        'name',
        'company_number',
        'mobile_number',
        'support_img',
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
