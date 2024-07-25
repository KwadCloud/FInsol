<?php

namespace App\Http\Controllers\User\LoanFinance;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\LoanFinance\ProjectReport;
use App\Models\PaymentValue;
use Illuminate\Http\Request;

class ProjectReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            ProjectReport::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'LFProjectReport';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Project Report and Payment received successfully!';
            } else {
                $msg = 'Registered Project Report successfully! But we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/loan-finance/project-report/register')->with('success', $msg);
        }

        $data['projectReportImages'] = Documents::where('for_multiple', 'LFPR')->get();
        $data['amount'] = PaymentValue::where('id', 35)->first()->value;
        return view('user.pages.loanfinance.projectReportForm')->with($data);
    }

    public function storeProjectReport(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/LoanFinance/LFProjectReport';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'LFPR');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_company'] = $request['name_of_company'];
        $data['mobile_number'] = $request['mobile_number'];
        $data['networth'] = $request['networth'];
        $data['project_address'] = $request['project_address'];
        $insert_data = ProjectReport::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for Project Report Register';
            $data['payment_amount'] = PaymentValue::where('id', 35)->first()->value;
            $data['name_of_pan'] = $data['name_of_company'];
            $data['type'] = 'LFProjectReport';
            $data['route'] = 'projectReport.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/loan-finance/project-report/register')->with('success', 'Registered Statutory Audit successfully!');
    }
}
