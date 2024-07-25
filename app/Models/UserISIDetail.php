<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserISIDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_isi_details';

    protected $fillable = [
        'user_id',
        'isi_number',
        'payment_status',
        'payment_unique_id',
        'email_id',
        'registration_type',
        'name_of_company',
        'company_number',
        'mobile_number',
        'certification_img',
        'property_img',
        'insurance_img',
        'rent_img',
        'telephone_img',
        'electricity_img',
        'bank_img',
        'aadhar_img',
        'voterid_img',
        'driving_license_img',
        'test_img',
        'machinery_list_img',
        'calibration_img',
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
