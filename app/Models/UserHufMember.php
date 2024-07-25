<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserHufMember extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_huf_member';

    protected $fillable = [
        'user_id',
        'user_huf_id',
        'name_of_member',
        'kyc_of_member_img',
        'docs_img',
    ];

}
