<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserUdamyDetail;
use Illuminate\Http\Request;

class UdamyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        echo "asdads";
        //  return view('user.pages.gst.details');
    }
    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserUdamyDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Udamy';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Udamy and Payment received successfully!';
            } else {
                $msg = 'Registered Udamy successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/udamy/register')->with('success', $msg);
        }

        $data['udamy_images'] = Documents::where('for_multiple', 'UDAMY')->get();
        $data['amount'] = PaymentValue::where('id', 13)->first()->value;
        return view('user.pages.udamy.udamyform')->with($data);
    }

    public function storeUdamy(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Udamy';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'UDAMY');
        $data['user_id'] = $userId;
        $data['name_of_udamy'] = $request['name_of_udamy'];
        $data['udamy_email'] = $request['udamy_email'];
        $data['udamy_mobile'] = $request['udamy_mobile'];
        $data['registration_type'] = $request->input('registration_type');
        $lastInsertedId = UserUdamyDetail::Create($data)->id;

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Udamy Register';
            $data['name_of_pan'] = $data['name_of_udamy'];
            $data['email_id'] = $data['udamy_email'];
            $data['mobile_number'] = $data['udamy_mobile'];
            $data['payment_amount'] = PaymentValue::where('id', 13)->first()->value;
            $data['type'] = 'Udamy';
            $data['route'] = 'udamy.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        return redirect('/udamy/register')->with('success', 'Registered Udamy successfully!');
    }
}
