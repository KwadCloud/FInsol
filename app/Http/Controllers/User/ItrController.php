<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserItrDetail;
use Illuminate\Http\Request;

class ItrController extends Controller
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
            UserItrDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Itr';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Itr and Payment received successfully!';
            } else {
                $msg = 'Registered Itr successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/itr/register')->with('success', $msg);
        }
        $data['itrimages'] = Documents::where('for_multiple', 'ITR')->get();
        $data['amount'] = PaymentValue::where('id', 21)->first()->value;
        return view('user.pages.itr.itrform')->with($data);
    }

    public function storeItr(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Itr';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'ITR');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_itr'] = $request['itr_name'];
        $data['mobile_number'] = $request['mobile_number'];
        $data['pan_number'] = $request['pan_number'];
        $data['financial_year'] = $request->input('financial_year');
        $data['assessment_year'] = $request->input('assessment_year');
        $lastInsertedId = UserItrDetail::Create($data)->id;

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Itr Register';
            $data['name_of_pan'] = $data['name_of_itr'];
            $data['email_id'] = $data['email_id'];
            $data['mobile_number'] = $data['mobile_number'];
            $data['payment_amount'] = PaymentValue::where('id', 21)->first()->value;
            $data['type'] = 'Itr';
            $data['route'] = 'itr.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        return redirect('/itr/register')->with('success', 'Registered Itr successfully!');
    }

}
