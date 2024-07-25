<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserDirector extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_directors';

    protected $fillable = [
        'user_id',
        'user_gst_id',
        'director_mobile',
        'director_email',
        'd_pancard_img',
        'd_aadharcard_img',
        'd_voterid_or_passport_img',
        'd_drivinglicence_img',
        'd_userphoto_img',
    ];

}
