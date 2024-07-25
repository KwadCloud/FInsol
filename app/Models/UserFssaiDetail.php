<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserFssaiDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_fssai_details';

    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_unique_id',
        'email_id',
        'registration_type',
        'name_of_fssai',
        'fssai_number',
        'mobile_number',
        'bill_img',
        'proof_img',
        'dec_img',
        'recall_img',
        'foods_img',
        'machine_img',
        'shop_img',
        'deed_img',
        'card_img',
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