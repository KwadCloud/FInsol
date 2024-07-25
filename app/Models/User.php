<?php

namespace App\Models;

use App\Models\CompaniesAct\UserAdtDetail;
use App\Models\CompaniesAct\UserAocDetail;
use App\Models\CompaniesAct\UserDinkycDetail;
use App\Models\CompaniesAct\UserMgtDetail;
use App\Models\CompaniesAct\UserMinutesDetail;
use App\Models\CompaniesAct\UserStatutoryAuditDetail;
use App\Models\UserCompanyDetail;
use App\Models\UserEpfDetail;
use App\Models\UserEsicDetail;
use App\Models\UserFactoryLicenseDetail;
use App\Models\UserFssaiDetail;
use App\Models\UserGstDetail;
use App\Models\UserHufDetail;
use App\Models\UserImportExportDetail;
use App\Models\UserIsoDetail;
use App\Models\UserItrDetail;
use App\Models\UserLabourDetail;
use App\Models\UserPanDetail;
use App\Models\UserPartnershipDetail;

// Itr Act
use App\Models\UserShopDetail;
use App\Models\UserTanDetail;
use App\Models\UserTaxauditDetail;

//Companies act
use App\Models\UserTdsDetail;
use App\Models\UserTrademarkDetail;
use App\Models\UserTrustDetail;
use App\Models\UserUdamyDetail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const NOT_ACTIVE = 'not_active';
    const ACTIVE = 'active';

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'aadhaar',
        'status',
        'address',
        'type_of_user',
        'block',
        'state',
        'district',
        'birth_year',
        'image',
        'original_image_path',
        'password',
        'mobile',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function getUserDocumentsPath($userId, $type)
    {
        $userDetails = User::find($userId);
        $folderName = $userDetails->name . '-' . $userDetails->id . '/Gst/';
        $path = $folderName . $type . '/';
        return $path;
    }

    protected function getAnyoftheformshasrecord()
    {
        $userId = auth()->user()->id;
        $a = UserGstDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $b = UserPanDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $c = UserTanDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $d = UserEpfDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $e = UserEsicDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $f = UserTrademarkDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $g = UserCompanyDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $h = UserPartnershipDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $i = UserHufDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $j = UserTrustDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $k = UserUdamyDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $l = UserImportExportDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $m = UserLabourDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $n = UserShopDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $o = UserIsoDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $p = UserFssaiDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $q = UserItrDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $r = UserTaxauditDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $s = UserTdsDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $t = UserFactoryLicenseDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        $rowcount = count($a) || count($b) || count($c) || count($d)
        || count($e) || count($f) || count($g) || count($h)
        || count($i) || count($j) || count($k) || count($l)
        || count($m) || count($n) || count($o) || count($p)
        || count($q) || count($r) || count($s) || count($t);
        return $rowcount;
    }

    protected function getCompaniesActhasrecord()
    {
        $userId = auth()->user()->id;
        $a = UserMgtDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $b = UserAdtDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $c = UserAocDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $d = UserMinutesDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $e = UserDinkycDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $e = UserStatutoryAuditDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $rowcount = count($a) || count($b) || count($c) || count($d)
        || count($e);
        return $rowcount;
    }
}
