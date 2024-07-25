<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserPanDetail;
use Illuminate\Http\Request;

class PanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserPanDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'PAN';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Pan and Payment received successfully!';
            } else {
                $msg = 'Registered Pan successfully! but we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/pan/register')->with('success', $msg);
        }

        $data['panimages'] = Documents::where('for_multiple', 'PAN')->get();
        $data['amount'] = PaymentValue::where('id', 4)->first()->value;
        return view('user.pages.pan.panform')->with($data);
    }

    public function storePan(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Pan';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'PAN');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_pan'] = $request['pan_name'];
        $data['mobile_number'] = $request['mobile_number'];
        $data['registration_type'] = $request->input('registration_type');
        $insert_data = UserPanDetail::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for Pan Register';
            $data['payment_amount'] = PaymentValue::where('id', 4)->first()->value;
            $data['type'] = 'PAN';
            $data['route'] = 'pan.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        return redirect('/pan/register')->with('success', 'Registered Pan successfully!');
    }

}
