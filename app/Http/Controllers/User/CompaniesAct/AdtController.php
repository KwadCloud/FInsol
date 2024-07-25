<?php
namespace App\Http\Controllers\User\CompaniesAct;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\CompaniesAct\UserAdtDetail;
use App\Models\Documents;
use App\Models\PaymentValue;
use Illuminate\Http\Request;

class AdtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserAdtDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Adt';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered ADT and Payment received successfully!';
            } else {
                $msg = 'Registered ADT successfully! But we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/adt/register')->with('success', $msg);
        }

        $data['adtimages'] = Documents::where('for_multiple', 'ADT')->get();
        $data['amount'] = PaymentValue::where('id', 27)->first()->value;
        return view('user.pages.companiesact.adtform')->with($data);
    }

    public function storeAdt(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/CompaniesAct/Adt';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'ADT');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_company'] = $request['name_of_company'];
        $data['mobile_number'] = $request['mobile_number'];
        $insert_data = UserAdtDetail::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for ADT Register';
            $data['payment_amount'] = PaymentValue::where('id', 27)->first()->value;
            $data['name_of_pan'] = $data['name_of_company'];
            $data['type'] = 'Adt';
            $data['route'] = 'adt.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/adt/register')->with('success', 'Registered Adt successfully!');
    }

}
