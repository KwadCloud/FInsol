<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\UserPayDetail;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserPayDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Custom';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Payment received successfully!';
            } else {
                $msg = 'We are unable to complete payment transaction. Please try again later.';
            }
            return redirect('/pay/register')->with('success', $msg);
        }

        return view('user.pages.pay.payform');
    }

    public function storePay(Request $request)
    {

        $userId = auth()->user()->id;
        $data['user_id'] = $userId;
        $data['name'] = $request['name'];
        $data['email_id'] = $request['email_id'];
        $data['mobile_number'] = $request['mobile_number'];
        $data['payment_for'] = $request['payment_for'];
        $data['amount'] = $request['amount'];

        $insert_data = UserPayDetail::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data["name_of_pan"] = $request['name'];
            $data['payment_purpose'] = $request['payment_for'];
            $data['payment_amount'] = $request['amount'];
            $data['type'] = 'Custom';
            $data['route'] = 'pay.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
    }

}
