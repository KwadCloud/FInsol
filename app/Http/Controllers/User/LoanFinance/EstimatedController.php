<?php

namespace App\Http\Controllers\User\LoanFinance;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\LoanFinance\Estimated;
use App\Models\PaymentValue;
use Illuminate\Http\Request;

class EstimatedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            Estimated::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'LFEstimated';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Estimated/Projected and Payment received successfully!';
            } else {
                $msg = 'Registered Estimated/Projected successfully! But we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/loan-finance/estimated/register')->with('success', $msg);
        }

        $data['estimatedImages'] = Documents::where('for_multiple', 'LF Estimated')->get();
        $data['amount'] = PaymentValue::where('id', 36)->first()->value;
        return view('user.pages.loanfinance.estimatedForm')->with($data);
    }

    public function storeEstimated(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/LoanFinance/LFEstimated';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'LF Estimated');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_company'] = $request['name_of_company'];
        $data['mobile_number'] = $request['mobile_number'];
        $insert_data = Estimated::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for LF Estimated Register';
            $data['payment_amount'] = PaymentValue::where('id', 36)->first()->value;
            $data['name_of_pan'] = $data['name_of_company'];
            $data['type'] = 'LFEstimated';
            $data['route'] = 'estimated.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/loan-finance/estimated/register')->with('success', 'Registered Estimation successfully!');
    }
}
