<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserGstUploadDocument extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_gst_upload_documents';

    protected $fillable = [
        'user_id',
        'gst_id',
        'documents',
        'doc_type',
        'year',
        'month',
        'quarter',
    ];

}
