<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserEpfDetail;
use App\Models\UserEpfSignatory;
use Illuminate\Http\Request;

class EpfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserEpfDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Epf';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Epf and Payment received successfully!';
            } else {
                $msg = 'Registered Epf successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/epf/register')->with('success', $msg);
        }
        $data['epf_company_images'] = Documents::where(['for_multiple' => 'EPF Company'])->get();
        $data['epf_company_signatory_images'] = Documents::where(['for_multiple' => 'EPF Signatory'])->get();
        $data['epf_other_images'] = Documents::where(['for_multiple' => 'EPF Others'])->get();
        $data['amount_epf_ci'] = PaymentValue::where('id', 6)->first()->value;
        $data['amount'] = PaymentValue::where('id', 43)->first()->value;
        return view('user.pages.epf.epfform')->with($data);
    }

    public function storeEpfCompany(Request $request)
    {
        $userId = auth()->user()->id;
        $dataon = 'epfsignatory';
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Epf/Company';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'EPF Company');
        $data['user_id'] = $userId;
        $data['epf_type'] = $request['epf_type'];
        $data['epf_mobile'] = $request['mobile_number'];
        $data['name_of_epf'] = $request['epf_name'];
        $data['epf_email'] = $request['email_id'];
        $lastInsertedId = UserEpfDetail::Create($data)->id;
        
        if ($request->has('epfsignatory')) {
            $epfsignatory = $request->input('epfsignatory');
            foreach ($epfsignatory as $key => $ps) {
                $folderName = 'public/uploads/users/' . $useName . '/Epf/Company/Signatory';
                $partner = Helper::uploadSignatoryImages($request, $key, $userId, $folderName, $dataon, 'EPF Signatory');
                $partner['user_epf_id'] = $lastInsertedId;
                $partner['user_id'] = $userId;
                $partner['epf_sign_email'] = $ps['email'];
                $partner['epf_sign_mobile'] = $ps['mobile'];
                UserEpfSignatory::Create($partner);
            }
        }
        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Epf Register';
            $data['name_of_pan'] = $data['name_of_epf'];
            $data['email_id'] = $data['epf_email'];
            $data['mobile_number'] = $data['epf_mobile'];
            $data['payment_amount'] = PaymentValue::where('id', 6)->first()->value;
            $data['type'] = 'Epf';
            $data['route'] = 'epf.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        return redirect('/epf/register')->with('success', 'Registered EPF successfully!');
    }

    public function storeEpfOthers(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Epf/Others';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, $for_multiple = 'EPF Others');
        $data['user_id'] = $userId;
        $data['epf_email'] = $request['email_id'];
        $data['epf_mobile'] = $request['mobile_number'];
        $data['epf_type'] = $request['epf_type'];
        $data['name_of_epf'] = $request['epf_name'];

        $lastInsertedId = UserEpfDetail::Create($data)->id;
        
        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Epf Register';
            $data['name_of_pan'] = $data['name_of_epf'];
            $data['email_id'] = $data['epf_email'];
            $data['mobile_number'] = $data['epf_mobile'];
            $data['payment_amount'] = PaymentValue::where('id', 43)->first()->value;
            $data['type'] = 'Epf';
            $data['route'] = 'epf.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        return redirect('/epf/register')->with('success', 'Registered EPF Others successfully!');
    }
}
