<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserTaxauditDetail;
use Illuminate\Http\Request;

class TaxauditController extends Controller
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
            UserTaxauditDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Taxaudit';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Taxaudit and Payment received successfully!';
            } else {
                $msg = 'Registered Taxaudit successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/taxaudit/register')->with('success', $msg);
        }
        $data['taxauditimages'] = Documents::where('for_multiple', 'TAXAUDIT')->get();
        $data['amount'] = PaymentValue::where('id', 22)->first()->value;
        return view('user.pages.taxaudit.taxauditform')->with($data);
    }

    public function storeTaxaudit(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Taxaudit';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'TAXAUDIT');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_taxaudit'] = $request['taxaudit_name'];
        $data['mobile_number'] = $request['mobile_number'];
        $data['gst_id'] = $request['gst_id'];
        $data['financial_year'] = $request->input('financial_year');
        $data['assessment_year'] = $request->input('assessment_year');
        $data['gst_password'] = $request['gst_password'];
        $lastInsertedId = UserTaxauditDetail::Create($data)->id;

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Taxaudit Register';
            $data['name_of_pan'] = $data['name_of_taxaudit'];
            $data['email_id'] = $data['email_id'];
            $data['mobile_number'] = $data['mobile_number'];
            $data['payment_amount'] = PaymentValue::where('id', 22)->first()->value;
            $data['type'] = 'Taxaudit';
            $data['route'] = 'taxaudit.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        return redirect('/taxaudit/register')->with('success', 'Registered Taxaudit successfully!');
    }

}
