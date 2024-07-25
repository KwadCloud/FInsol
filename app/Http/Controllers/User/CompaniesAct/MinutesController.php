<?php
namespace App\Http\Controllers\User\CompaniesAct;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\CompaniesAct\UserMinutesDetail;
use App\Models\Documents;
use App\Models\PaymentValue;
use Illuminate\Http\Request;

class MinutesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserMinutesDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Minutes';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Minutes and Payment received successfully!';
            } else {
                $msg = 'Registered Minutes successfully! But we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/minutes/register')->with('success', $msg);
        }

        $data['minutesimages'] = Documents::where('for_multiple', 'MINUTES')->get();
        $data['amount'] = PaymentValue::where('id', 25)->first()->value;
        return view('user.pages.companiesact.minutesform')->with($data);
    }

    public function storeMinutes(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/CompaniesAct/Minutes';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'MINUTES');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_company'] = $request['name_of_company'];
        $data['mobile_number'] = $request['mobile_number'];
        $insert_data = UserMinutesDetail::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for Minutes Register';
            $data['name_of_pan'] = $data['name_of_company'];
            $data['payment_amount'] = PaymentValue::where('id', 25)->first()->value;
            $data['type'] = 'Minutes';
            $data['route'] = 'minutes.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/minutes/register')->with('success', 'Registered Minutes successfully!');
    }

}
