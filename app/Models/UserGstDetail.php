<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserGstDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'users_gst_details';

    protected $fillable = [
        'user_id',
        'email_id',
        'payment_status',
        'payment_unique_id',
        'gst_type',
        'mobile_linked_aadhar',
        'trade_name',
        'pancard_img',
        'aadharcard_img',
        'voterid_or_passport_img',
        'drivinglicence_img',
        'userphoto_img',
        'rentalagreement_img',
        'electricitybill_img',
        'municipallandreceipt_img',
        'aadharpan_landlord_img',
        'aoa_img',
        'moa_img',
        'docs_img',
        'status',
        'last_updated_by',
        'last_update_by_id',
        'additional_img',
        'approved_img',
        'raised_img',
        'admin_note',
        'user_note',
        'gst_id',
        'gst_password',
        'gst_number',
    ];

}
