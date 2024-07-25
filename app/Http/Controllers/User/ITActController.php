<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\UserItrDetail;
use App\Models\UserTaxauditDetail;
use App\Models\UserTdsDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\PaymentValue;

class ITActController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (isset($request->payment_id) && !empty($request->payment_request_id)) {
            $this->storePaymentData($request);
        }
        $userId = auth()->user()->id;
        $data['userTaxauditDetails'] = UserTaxauditDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['userItrDetails'] = UserItrDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['userTdsDetails'] = UserTdsDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        
        $data['itr_instamojo_amount'] = PaymentValue::where('id', 21)->first()->value;
        $data['tax_instamojo_amount'] = PaymentValue::where('id', 22)->first()->value;
        $data['tds_instamojo_amount'] = PaymentValue::where('id', 23)->first()->value;

        return view('user.pages.it-act.dashboard.dashboard')->with($data);
    }

    public function queryRaised(Request $request)
    {
        $userId = auth()->user()->id;
        $formType = $request->form_type;
        $id = $request->id;
        if ($id) {
            $useName = $userId;
            $folderName = 'public/uploads/users/' . $useName . '/' . $formType . '/AdditionalImg';
            $name = 'additional_img';
            $img = Helper::uploadImagesNormal($request, $userId, $folderName, $name);
            if ($formType == 'Taxaudit') {
                $datas = UserTaxauditDetail::find($id);
            }
            if ($formType == 'ITR') {
                $datas = UserItrDetail::find($id);
            }
            if ($formType == 'TDS') {
                $datas = UserTdsDetail::find($id);
            }
            $datas->user_note = $request->user_note;
            $datas->status = 3; // Query Updated
            $datas->last_update_by = 'user';
            $datas->last_update_by_id = $userId;
            $datas->additional_img = $img['additional_img'];
            $datas->save();
            return redirect('/it-act/dashboard')->with('success', 'Uploaded the Document!');
        }
    }

    public function approvedFile(Request $request)
    {

        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $userId = auth()->user()->id;
        $useName = $userId;
        $formType = $request->form_type;
        $zipName = $formType . 'ApprovedFile-' . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'ApprovedImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('/it-act/dashboard')->with('givenfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'ApprovedImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('/it-act/dashboard')->with('givenfilenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }

    public function raisedFile(Request $request)
    {
        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $userId = auth()->user()->id;
        $formType = $request->form_type;
        $useName = $userId;
        $zipName = $formType . 'QueryRaisedFile-' . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'RaisedImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('/it-act/dashboard')->with('givenfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'RaisedImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('/it-act/dashboard')->with('givenfilenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }

    public function createInstaMojoOrder(Request $request)
    {
        // Session::put('form_type', $request->form_type);
        $request->session()->put('form_type', $request->form_type);

        $this->payment_type = $request->form_type;
        $userId = auth()->user()->id;
        $data['insert_id'] = $request->insert_id;
        $data['payment_purpose'] = 'Payment for ' . $request->payment_purpose . ' Register';
        $data['payment_amount'] = $request->payment_amount;
        $data['type'] = $request->form_type;
        $data['route'] = $request->route;
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_pan'] = $request['name_of_pan'];
        $data['mobile_number'] = $request['mobile_number'];

        $payment_Req = Helper::createInstaMojoOrder($data);
    }

    public function storePaymentData($data)
    {
        $form_type = session()->get('form_type');
        if ($form_type == 'Itr') {
            UserItrDetail::where('payment_unique_id', '=', $data->payment_request_id)->update(array('payment_status' => $data->payment_status));
        } else if ($form_type == 'Taxaudit') {
            UserTaxauditDetail::where('payment_unique_id', '=', $data->payment_request_id)->update(array('payment_status' => $data->payment_status));
        } else if ($form_type == 'Tds') {
            UserTdsDetail::where('payment_unique_id', '=', $data->payment_request_id)->update(array('payment_status' => $data->payment_status));
        }

        $response = $data->toArray();
        $response['userid'] = auth()->user()->id;
        $response['type'] = $form_type;

        Helper::storePaymentResponse($response);

        if ($data->payment_status == 'Credit') {
            $msg = 'Payment received successfully!';
        } else {
            $msg = 'We are unable to complete payment transaction. Please contact to Administrator.';
        }
        return redirect('it-act/dashboard')->with('payment_success', $msg);
    }
}
