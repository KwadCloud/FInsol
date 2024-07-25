<?php
namespace App\Http\Controllers\User\Certification;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Certification\UserNetworthDetail;
use App\Models\Documents;
use App\Models\PaymentValue;
use Illuminate\Http\Request;

class NetworthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserNetworthDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Networth';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Networth and Payment received successfully!';
            } else {
                $msg = 'Registered Networth successfully! But we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/networth/register')->with('success', $msg);
        }

        $data['networthimages'] = Documents::where('for_multiple', 'NETWORTH')->get();
        $data['amount'] = PaymentValue::where('id', 32)->first()->value;
        return view('user.pages.certification.networthform')->with($data);
    }

    public function storeNetworth(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Certification/Networth';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'NETWORTH');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name'] = $request['name'];
        $data['mobile_number'] = $request['mobile_number'];
        $insert_data = UserNetworthDetail::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for Networth Register';
            $data['payment_amount'] = PaymentValue::where('id', 32)->first()->value;
            $data['name_of_pan'] = $data['name'];
            $data['type'] = 'Networth';
            $data['route'] = 'networth.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/networth/register')->with('success', 'Registered Networth successfully!');
    }

}
