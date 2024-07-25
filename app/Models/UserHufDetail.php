<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserHufDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_huf_details';

    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_unique_id',
        'name_of_huf',
        'huf_number',
        'huf_email',
        'registration_type',
        'huf_mobile',
        'name_of_karta',
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
