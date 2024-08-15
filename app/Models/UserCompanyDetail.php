<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserCompanyDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_company_details';

    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_unique_id',
        'name_of_company',
        'company_number',
        'company_email',
        'company_mobile',
        'comp_rent_elec_img',
        'comp_kyc_img',
        'comp_certificate_img',
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
