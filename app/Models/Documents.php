<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Documents extends Authenticatable
{
    use Notifiable;

    protected $table = 'documents';

    protected $fillable = [
        'doc_key_name',
        'doc_name',
        'gst_type_val',
    ];

}
