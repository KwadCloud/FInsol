<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserFactoryLicenseDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_factorylicense_details';

    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_unique_id',
        'name_of_facl',
        'facl_number',
        'facl_email',
        'registration_type',
        'facl_mobile',
        'land_img',
        'dep_img',
        'article_img',
        'act_img',
        'board_img',
        'proof_img',
        'plant_img',
        'raw_img',
        'owned_img',
        'app_img',
        'llp_img',
        'prj_img',
        'poll_img',
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
