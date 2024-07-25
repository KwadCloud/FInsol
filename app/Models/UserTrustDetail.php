<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserTrustDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_trust_details';

    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_unique_id',
        'name_of_trust',
        'trust_number',
        'trust_email',
        'registration_type',
        'trust_mobile',
        'name_of_trust',
        'docs_img',
        'status',
        'last_updated_by',
        'last_update_by_id',
        'additional_img',
        'address_proof_img',
        'approved_img',
        'raised_img',
        'admin_note',
        'user_note',
        'type',
    ];
}
