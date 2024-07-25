<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserISIDetail;
use Illuminate\Http\Request;

class ISIController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserISIDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'ISI';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Estimated/Projected and Payment received successfully!';
            } else {
                $msg = 'Registered Estimated/Projected successfully! But we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/isi/register')->with('success', $msg);
        }

        $data['isiImages'] = Documents::where('for_multiple', 'ISI')->get();
        $data['amount'] = PaymentValue::where('id', 37)->first()->value;
        return view('user.pages.isi.isiForm')->with($data);
    }

    public function storeISI(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/ISI';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'ISI');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_company'] = $request['name_of_company'];
        $data['mobile_number'] = $request['mobile_number'];
        $data['registration_type'] = $request->input('registration_type');
        $insert_data = UserISIDetail::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for ISI Register';
            $data['payment_amount'] = PaymentValue::where('id', 37)->first()->value;
            $data['name_of_pan'] = $data['name_of_company'];
            $data['type'] = 'ISI';
            $data['route'] = 'isi.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/isi/register')->with('success', 'Registered ISI successfully!');
    }
}
