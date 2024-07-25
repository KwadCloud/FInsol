<?php

namespace App\Http\Controllers\User\LoanFinance;

use App\Http\Controllers\Controller;
use App\Models\LoanFinance\CMA;
use App\Models\LoanFinance\Estimated;
use App\Models\LoanFinance\ProjectReport;
use App\Models\PaymentValue;
use Illuminate\Http\Request;
use App\Helpers\Helper as Helper;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (isset ($request->payment_id) && !empty ($request->payment_request_id)) {
            $this->storePaymentData($request);
        }
        $userId = auth()->user()->id;
        $data['estimated'] = Estimated::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['cma'] = CMA::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['projectReport'] = ProjectReport::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['cma_instamojo_amount'] = PaymentValue::where('id', 34)->first()->value;
        $data['estimated_instamojo_amount'] = PaymentValue::where('id', 36)->first()->value;
        $data['project_instamojo_amount'] = PaymentValue::where('id', 35)->first()->value;

        return view('user.pages.loanfinance.dashboard.dashboard')->with($data);
    }

    public function queryRaised(Request $request)
    {
        $userId = auth()->user()->id;
        $formType = $request->form_type;
        $id = $request->id;
        if ($id) {
            $useName = $userId;
            $folderName = 'public/uploads/users/' . $useName . '//LoanFinance/' . $formType . '/AdditionalImg';
            $name = 'additional_img';
            $img = Helper::uploadImagesNormal($request, $userId, $folderName, $name);
            if ($formType == 'CMA') {
                $datas = CMA::find($id);
            }
            if ($formType == 'LFProjectReport') {
                $datas = ProjectReport::find($id);
            }
            if ($formType == 'LFEstimated') {
                $datas = Estimated::find($id);
            }
            $datas->user_note = $request->user_note;
            $datas->status = 3; // Query Updated
            $datas->last_update_by = 'user';
            $datas->last_update_by_id = $userId;
            $datas->additional_img = $img['additional_img'];
            $datas->save();
            return redirect('/loan-finance/dashboard')->with('success', 'Uploaded the Document!');
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
                $filePath = 'public/uploads/users/' . $useName . '//LoanFinance/' . $formType . '/' . 'ApprovedImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('/loan-finance/dashboard')->with('givenfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '//LoanFinance/' . $formType . '/' . 'ApprovedImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('/loan-finance/dashboard')->with('givenfilenotexist', 'File Not Exist!');
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
                $filePath = 'public/uploads/users/' . $useName . '//LoanFinance/' . $formType . '/' . 'RaisedImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('/loan-finance/dashboard')->with('givenfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '//LoanFinance/' . $formType . '/' . 'RaisedImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('/loan-finance/dashboard')->with('givenfilenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }

    public function createInstaMojoOrder(Request $request)
    {
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

        if ($form_type == 'CMA') {
            CMA::where('payment_unique_id', '=', $data->payment_request_id)->update(array('payment_status' => $data->payment_status));
        } else if ($form_type == 'LFEstimated') {
            Estimated::where('payment_unique_id', '=', $data->payment_request_id)->update(array('payment_status' => $data->payment_status));
        } else if ($form_type == 'LFProjectReport') {
            ProjectReport::where('payment_unique_id', '=', $data->payment_request_id)->update(array('payment_status' => $data->payment_status));
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
        return redirect('loan-finance/dashboard')->with('payment_success', $msg);
    }
}
