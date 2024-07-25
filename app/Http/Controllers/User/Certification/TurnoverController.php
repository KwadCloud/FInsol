<?php
namespace App\Http\Controllers\User\Certification;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Certification\UserTurnoverDetail;
use App\Models\Documents;
use App\Models\PaymentValue;
use Illuminate\Http\Request;

class TurnoverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserTurnoverDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Turnover';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Turnover and Payment received successfully!';
            } else {
                $msg = 'Registered Turnover successfully! But we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/turnover/register')->with('success', $msg);
        }

        $data['turnoverimages'] = Documents::where('for_multiple', 'TURNOVER')->get();
        $data['amount'] = PaymentValue::where('id', 33)->first()->value;
        return view('user.pages.certification.turnoverform')->with($data);
    }

    public function storeTurnover(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Certification/Turnover';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'TURNOVER');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name'] = $request['name'];
        $data['mobile_number'] = $request['mobile_number'];
        $insert_data = UserTurnoverDetail::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for Turnover Register';
            $data['payment_amount'] = $data['amount'] = PaymentValue::where('id', 33)->first()->value;
            $data['name_of_pan'] = $data['name'];
            $data['type'] = 'Turnover';
            $data['route'] = 'turnover.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/turnover/register')->with('success', 'Registered Turnover successfully!');
    }

}
