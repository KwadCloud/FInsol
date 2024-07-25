<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserTdsDetail;
use Illuminate\Http\Request;

class TdsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //  return view('user.pages.gst.details');
    }
    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserTdsDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Tds';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Tds and Payment received successfully!';
            } else {
                $msg = 'Registered Tds successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/tds/register')->with('success', $msg);
        }
        $data['tdsimages'] = Documents::where('for_multiple', 'TDS')->get();
        $data['amount'] = PaymentValue::where('id', 23)->first()->value;
        return view('user.pages.tds.tdsform')->with($data);
    }

    public function storeTds(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Tds';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'TDS');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_tds'] = $request['tds_name'];
        $data['mobile_number'] = $request['mobile_number'];
        $data['tds_rate'] = $request['tds_rate'];
        $data['tds_amount'] = $request['tds_amount'];
        $data['tds_date'] = $request['tds_date'];
        $data['section'] = $request['section'];
        $data['financial_year'] = $request->input('financial_year');
        $data['assessment_year'] = $request->input('assessment_year');
        $lastInsertedId = UserTdsDetail::Create($data)->id;

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Tds Register';
            $data['name_of_pan'] = $data['name_of_tds'];
            $data['email_id'] = $data['email_id'];
            $data['mobile_number'] = $data['mobile_number'];
            $data['payment_amount'] = PaymentValue::where('id', 23)->first()->value;
            $data['type'] = 'Tds';
            $data['route'] = 'tds.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/tds/register')->with('success', 'Registered Tds/Tcs successfully!');
    }

}
