<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\UserEpfDetail;
use App\Models\UserEsicDetail;
use App\Models\UserFactoryLicenseDetail;
use App\Models\UserFssaiDetail;
use App\Models\UserGstDetail;
use App\Models\UserImportExportDetail;
use App\Models\UserIsoDetail;
use App\Models\UserItrDetail;
use App\Models\UserLabourDetail;
use App\Models\UserPayDetail;
use App\Models\UserShopDetail;
use App\Models\UserTaxauditDetail;
use App\Models\UserTdsDetail;
use App\Models\UserTrademarkDetail;
use App\Models\UserTrustDetail;
use App\Models\UserUdamyDetail;
use Illuminate\Support\Facades\Storage;
use App\Models\UserPanDetail;
use App\Models\UserTanDetail;
use App\Models\UserCompanyDetail;
use App\Models\UserPartnershipDetail;
use App\Models\UserHufDetail;
use App\Models\Instamojo;
use Illuminate\Support\Facades\File;
use App\Models\Documents;
use App\Models\CompaniesAct\UserStatutoryAuditDetail;
use App\Models\CompaniesAct\UserAdtDetail;
use App\Models\CompaniesAct\UserAocDetail;
use App\Models\CompaniesAct\UserDinkycDetail;
use App\Models\CompaniesAct\UserMgtDetail;
use App\Models\CompaniesAct\UserMinutesDetail;
use App\Models\Certification\UserCaDetail;
use App\Models\Certification\UserNetworthDetail;
use App\Models\Certification\UserTurnoverDetail;
use App\Models\LoanFinance\CMA;
use App\Models\LoanFinance\Estimated;
use App\Models\LoanFinance\ProjectReport;
use App\Models\UserISIDetail;
use Illuminate\Support\Facades\Session;
use App\Models\LegalWork;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function uploadImages($request, $userId, $gst_type_val, $folderName, $for_multiple = null)
    {
        $userFolder = $folderName;
        if (!File::exists($userFolder)) {
            File::makeDirectory($userFolder, 0777, true, true);
        }
        $where = [];

        if ($for_multiple != null) {
            $where = ['gst_type_val' => $gst_type_val, 'for_multiple' => $for_multiple];
        } else {
            $where = ['gst_type_val' => $gst_type_val];
        }

        $allimages = Documents::where($where)->get();
        $data = [];
        foreach ($allimages as $img) {
            $keyname = $img['doc_key_name'];
            $imgName = str_replace(' ', '', $img['filename']);
            if ($request->hasFile($keyname)) {
                $images = $request->file($keyname);
                $related_imgs = [];
                foreach ($images as $index => $image) {
                    $newName = $imgName . '_' . ($index + 1) . '_' . mt_rand(2000, 9000) . $userId . '.' . $image->getClientOriginalExtension();
                    $path = $image->move($userFolder, $newName);
                    $related_imgs[] = $newName;
                }
                $data[$keyname] = implode(',', $related_imgs);
            }
        }
        return $data;
    }

    public static function uploadImagesNew($request, $userId, $folderName, $for_multiple)
    {
        $userFolder = $folderName;
        if (!File::exists($userFolder)) {
            File::makeDirectory($userFolder, 0777, true, true);
        }
        $where = [];

        $where = ['for_multiple' => $for_multiple];

        $allimages = Documents::where($where)->get();
        $data = [];
        foreach ($allimages as $img) {
            $keyname = $img['doc_key_name'];
            if ($request->hasFile($keyname)) {
                $images = $request->file($keyname);

                $related_imgs = [];
                foreach ($images as $index => $image) {
                    $newName = ($index + 1) . '_' . mt_rand(2000, 9000) . $userId . '.' . $image->getClientOriginalExtension();
                    $path = $image->move($userFolder, $newName);
                    $related_imgs[] = $newName;
                }
                $data[$keyname] = implode(',', $related_imgs);
            }
        }
        return $data;
    }

    public static function uploadImagesNormal($request, $userId, $folderName, $name)
    {
        $userFolder = $folderName;
        if (!File::exists($userFolder)) {
            File::makeDirectory($userFolder, 0777, true, true);
        }
        $keyname = $name;
        $data[$keyname] = "";
        //   if ($request->hasFile($keyname)) {
        if ($request->file($keyname)) {
            $images = $request->file($keyname);
            $related_imgs = [];
            foreach ($images as $index => $image) {
                //     $maxSize = 2 * 1024 * 1024; 
                //     if ($image && $image->getSize() > $maxSize) {
                //     // File size exceeds the limit
                //     return back()->withErrors('The selected file exceeds the maximum allowed size (2MB).');
                // }
                $newName = ($index + 1) . '_' . mt_rand(2000, 9000) . $userId . '.' . $image->getClientOriginalExtension();
                $path = $image->move($userFolder, $newName);
                $related_imgs[] = $newName;
            }
            $data[$keyname] = implode(',', $related_imgs);
        }
        return $data;
    }

    public static function uploadSignatoryImages($request, $key, $userId, $folderName, $dataon, $for_multiple)
    {
        $userFolder = $folderName;
        if (!File::exists($userFolder)) {
            File::makeDirectory($userFolder, 0777, true, true);
        }
        $allimages = Documents::where(['for_multiple' => $for_multiple])->get();
        $data = [];
        foreach ($allimages as $img) {
            if ($request->file($dataon)) {
                $keyname = $img['doc_key_name'];
                $imgName = str_replace(' ', '', $img['filename']);
                $images = $request->file($dataon)[$key];
                $related_imgs = [];
                if (isset($images[$keyname])) {
                    foreach ($images[$keyname] as $index => $p) {
                        $newName = $imgName . '_' . ($index + 1) . '_' . ($key) . '_' . mt_rand(2000, 9000) . '.' . $p->getClientOriginalExtension();
                        $imagePath = $p->move($folderName, $newName);
                        $related_imgs[] = $newName;
                    }
                }
                $data[$keyname] = implode(',', $related_imgs);
            }
        }
        return $data;
    }

    public static function uploadAddMultipleImages($request, $key, $userId, $folderName, $dataon, $for_multiple)
    {
        $userFolder = $folderName;
        if (!File::exists($userFolder)) {
            File::makeDirectory($userFolder, 0777, true, true);
        }
        $allimages = Documents::where(['for_multiple' => $for_multiple])->get();
        $data = [];

        foreach ($allimages as $img) {
            if ($request->file($dataon)) {
                $keyname = $img['doc_key_name'];
                // $imgName = str_replace(' ', '', $img['filename']);
                $images = $request->file($dataon)[$key];
                $related_imgs = [];
                if (isset($images[$keyname])) {
                    foreach ($images[$keyname] as $index => $p) {
                        $newName = ($index + 1) . '_' . ($key) . '_' . mt_rand(2000, 9000) . '.' . $p->getClientOriginalExtension();
                        $imagePath = $p->move($folderName, $newName);
                        $related_imgs[] = $newName;
                    }
                }
                $data[$keyname] = implode(',', $related_imgs);
            }
        }
        return $data;
    }

    public static function getBaseUrl($request)
    {
        $url = $request->url();
        $parsedUrl = parse_url($url);
        $baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];

        if (isset($parsedUrl['port'])) {
            $baseUrl .= ':' . $parsedUrl['port'];
        }
        $pathSegments = explode('/', trim($parsedUrl['path'], '/'));
        if ($parsedUrl['host'] == 'localhost') {
            $baseSegment = implode('/', array_slice($pathSegments, 0, 1));
        } else {
            $baseSegment = implode('/', array_slice($pathSegments, 0, 2));
        }

        return $baseURL = $baseUrl . '/' . $baseSegment;




    }

    public static function createInstaMojoOrder($data)
    {
        $api = new \Instamojo\Instamojo(
            env('INSTAMOJO_TEST_API_KEY'),
            env('INSTAMOJO_TEST_AUTH_TOKEN'),
            env('INSTAMOJO_TEST_URL'),
        );

        session()->put('form_type', $data["type"]);
        session()->put('payment_amount', $data["payment_amount"]);
        session()->save();
        $response = $api->paymentRequestCreate([
            "purpose" => $data["payment_purpose"],
            "amount" => $data["payment_amount"],
            "buyer_name" => $data["name_of_pan"],
            "email" => $data["email_id"],
            "phone" => $data["mobile_number"],
            "redirect_url" => route($data['route']),
        ]);
 
        if(isset($response['id']) && !empty($response['id'])){
            if($data["type"] == 'TAN'){
                UserTanDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'PAN'){
                UserPanDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'StatutoryAudit'){
                UserStatutoryAuditDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Adt'){
                UserAdtDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Aoc'){
                UserAocDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Dinkyc'){
                UserDinkycDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Mgt'){
                UserMgtDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Minutes'){
                UserMinutesDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Ca'){
                UserCaDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Networth'){
                UserNetworthDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Turnover'){
                UserTurnoverDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'CMA'){
                CMA::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'LFEstimated'){
                Estimated::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'LFProjectReport'){
                ProjectReport::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'ISI'){
                UserISIDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Partnership'){
                UserPartnershipDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Company'){
                UserCompanyDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Huf'){
                UserHufDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Trust'){
                UserTrustDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Udamy'){
                UserUdamyDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Import'){
                UserImportExportDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Shop'){
                UserShopDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'ISO'){
                UserIsoDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Fssai'){
                UserFssaiDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Factory'){
                UserFactoryLicenseDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Gst'){
                UserGstDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Epf'){
                UserEpfDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Esic'){
                UserEsicDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Trademark'){
                UserTrademarkDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Labour'){
                UserLabourDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Itr'){
                UserItrDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Tds'){
                UserTdsDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Taxaudit'){
                UserTaxauditDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Custom'){
                UserPayDetail::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
            else if($data["type"] == 'Legal'){
                LegalWork::where('id', '=', $data["insert_id"])->update(array('payment_unique_id' => $response['id']));
            }
        }

        //var_dump($response);die();

        header('Location: ' . $response['longurl']."?form_type=".$data["type"]);
        exit();
    }

    public static function storePaymentResponse($data){
        $amount = session()->get('payment_amount');

        $data['staus'] = $data['payment_status'];
        $data['user_id'] = $data['userid'];
        $data['type'] = $data['type'];
        $data['amount'] = $amount;
        $data['payment_id'] = $data['payment_id'];
        $data['payment_request_id'] = $data['payment_request_id'];
        Instamojo::Create($data);
    }
}