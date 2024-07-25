<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserFssaiDetail;
use Illuminate\Http\Request;

class FssaiController extends Controller
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
            UserFssaiDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Fssai';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Fssai and Payment received successfully!';
            } else {
                $msg = 'Registered Fssai successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/fssai/register')->with('success', $msg);
        }

        $data['fssaiimages'] = Documents::where('for_multiple', 'FSSAI')->get();
        $data['amount'] = PaymentValue::where('id', 20)->first()->value;
        return view('user.pages.fssai.fssaiform')->with($data);
    }

    public function storeFssai(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Fssai';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'FSSAI');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_fssai'] = $request['fssai_name'];
        $data['mobile_number'] = $request['mobile_number'];
        $data['registration_type'] = $request->input('registration_type');
        $matchthese = ['user_id' => $userId];
        $lastInsertedId = UserFssaiDetail::Create($data)->id;

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Fssai Register';
            $data['name_of_pan'] = $data['name_of_fssai'];
            $data['email_id'] = $data['email_id'];
            $data['mobile_number'] = $data['mobile_number'];
            $data['payment_amount'] = PaymentValue::where('id', 20)->first()->value;
            $data['type'] = 'Fssai';
            $data['route'] = 'fssai.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/fssai/register')->with('success', 'Registered Fssai successfully!');
    }

}
