<?php

namespace App\Http\Controllers\User\LoanFinance;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\LoanFinance\CMA;
use App\Models\PaymentValue;
use Illuminate\Http\Request;

class CMAController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            CMA::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'CMA';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered CMA and Payment received successfully!';
            } else {
                $msg = 'Registered CMA successfully! But we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/loan-finance/cma/register')->with('success', $msg);
        }

        $data['cmaImages'] = Documents::where('for_multiple', 'LFCMA')->get();
        $data['amount'] = PaymentValue::where('id', 34)->first()->value;
        return view('user.pages.loanfinance.cmaForm')->with($data);
    }

    public function storeCMA(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/LoanFinance/CMA';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'LFCMA');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_company'] = $request['name_of_company'];
        $data['mobile_number'] = $request['mobile_number'];
        $insert_data = CMA::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for CMA Register';
            $data['payment_amount'] = PaymentValue::where('id', 34)->first()->value;
            $data['name_of_pan'] = $data['name_of_company'];
            $data['type'] = 'CMA';
            $data['route'] = 'cma.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/loan-finance/cma/register')->with('success', 'Registered CMA successfully!');
    }
}
