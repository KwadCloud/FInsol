<?php
namespace App\Http\Controllers\User\CompaniesAct;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\CompaniesAct\UserStatutoryAuditDetail;
use App\Models\Documents;
use App\Models\PaymentValue;
use Illuminate\Http\Request;

class StatutoryAuditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserStatutoryAuditDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'StatutoryAudit';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Statutory Audit and Payment received successfully!';
            } else {
                $msg = 'Registered Statutory Audit successfully! But we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/pan/register')->with('success', $msg);
        }

        $data['statutoryauditimages'] = Documents::where('for_multiple', 'SA')->get();
        $data['amount'] = PaymentValue::where('id', 30)->first()->value;
        return view('user.pages.companiesact.statutoryauditform')->with($data);
    }

    public function storeAudit(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/CompaniesAct/StatutoryAudit';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'SA');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_company'] = $request['name_of_company'];
        $data['mobile_number'] = $request['mobile_number'];
        $insert_data = UserStatutoryAuditDetail::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for Statutory Audit Register';
            $data['payment_amount'] = PaymentValue::where('id', 30)->first()->value;
            $data['name_of_pan'] = $data['name_of_company'];
            $data['type'] = 'StatutoryAudit';
            $data['route'] = 'statutoryaudit.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/statutoryaudit/register')->with('success', 'Registered Statutory Audit successfully!');
    }
}
