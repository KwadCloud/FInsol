<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class LegalWork extends Authenticatable
{
    use Notifiable;

    protected $table = 'legal_works';

    protected $fillable = [
        'user_id',
        'name',
        'mobile_number',
        'company_number',
        'email_id',
        'payment_status',
        'payment_unique_id',
        'company_mobile',
        'form_type',
        'subject',
        'description',
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
