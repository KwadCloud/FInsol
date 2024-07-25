<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserImportExportDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_importexport_details';

    protected $fillable = [
        'user_id',
        'name_of_firm',
        'payment_status',
        'payment_unique_id',
        'firm_number',
        'firm_email',
        'registration_type',
        'firm_mobile',
        'firm_pan_img',
        'cheque_img',
        'rent_img',
        'electrcity_img',
        'address_img',
        'auth_pan_img',
        'auth_aadhar_img',
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
