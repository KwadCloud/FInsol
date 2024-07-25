<?php

namespace App\Models\LoanFinance;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Estimated extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_loan_estimated';

    protected $fillable = [
        'user_id',
        'email_id',
        'payment_status',
        'payment_unique_id',
        'name_of_company',
        'company_number',
        'mobile_number',
        'proposed_amount',
        'previousReport_img',
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
