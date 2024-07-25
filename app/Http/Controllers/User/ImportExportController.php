<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserImportExportDetail;
use Illuminate\Http\Request;

class ImportExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserImportExportDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Import';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Import Export Code and Payment received successfully!';
            } else {
                $msg = 'Registered Import Export Code successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/importexport/register')->with('success', $msg);
        }
        $data['import_export_images'] = Documents::where('for_multiple', 'IE')->get();
        $data['amount'] = PaymentValue::where('id', 14)->first()->value;
        return view('user.pages.importexport.importexportform')->with($data);
    }

    public function storeImportExport(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/ImportExport';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'IE');
        $data['user_id'] = $userId;
        $data['name_of_firm'] = $request['name_of_firm'];
        $data['firm_email'] = $request['firm_email'];
        $data['firm_mobile'] = $request['firm_mobile'];
        $data['registration_type'] = $request->input('registration_type');
        $lastInsertedId = UserImportExportDetail::Create($data)->id;

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for importexport Code Register';
            $data['name_of_pan'] = $data['name_of_firm'];
            $data['email_id'] = $data['firm_email'];
            $data['mobile_number'] = $data['firm_mobile'];
            $data['payment_amount'] = PaymentValue::where('id', 14)->first()->value;
            $data['type'] = 'Import';
            $data['route'] = 'importexport.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        return redirect('/importexport/register')->with('success', 'Registered ImportExport successfully!');
    }

}
