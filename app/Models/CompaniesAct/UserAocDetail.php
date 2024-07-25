<?php

namespace App\Models\CompaniesAct;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAocDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_aoc_details';

    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_unique_id',
        'email_id',
        'name_of_company',
        'company_number',
        'mobile_number',
        'audit_img',
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
