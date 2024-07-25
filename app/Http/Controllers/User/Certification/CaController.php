<?php
namespace App\Http\Controllers\User\Certification;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Certification\UserCaDetail;
use App\Models\Documents;
use App\Models\PaymentValue;
use Illuminate\Http\Request;

class CaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserCaDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'CA';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered CA and Payment received successfully!';
            } else {
                $msg = 'Registered CA successfully! But we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/ca/register')->with('success', $msg);
        }

        $data['caimages'] = Documents::where('for_multiple', 'CA')->get();
        $data['amount'] = PaymentValue::where('id', 31)->first()->value;
        return view('user.pages.certification.caform')->with($data);
    }

    public function storeCa(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Certification/Ca';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'CA');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name'] = $request['name'];
        $data['mobile_number'] = $request['mobile_number'];
        $insert_data = UserCaDetail::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for CA Register';
            $data['name_of_pan'] = $data['name'];
            $data['payment_amount'] = PaymentValue::where('id', 31)->first()->value;
            $data['type'] = 'CA';
            $data['route'] = 'ca.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/ca/register')->with('success', 'Registered Ca successfully!');
    }

}
