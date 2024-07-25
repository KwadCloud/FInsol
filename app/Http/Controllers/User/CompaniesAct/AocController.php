<?php
namespace App\Http\Controllers\User\CompaniesAct;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\CompaniesAct\UserAocDetail;
use App\Models\Documents;
use App\Models\PaymentValue;
use Illuminate\Http\Request;

class AocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserAocDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Aoc';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered AOC and Payment received successfully!';
            } else {
                $msg = 'Registered AOC successfully! But we are unable to complete payment transaction. Please contact to Administrator.';
            }
            return redirect('/aoc/register')->with('success', $msg);
        }

        $data['aocimages'] = Documents::where('for_multiple', 'AOC')->get();
        $data['amount'] = PaymentValue::where('id', 28)->first()->value;
        return view('user.pages.companiesact.aocform')->with($data);
    }

    public function storeAoc(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/CompaniesAct/Aoc';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'AOC');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['name_of_company'] = $request['name_of_company'];
        $data['mobile_number'] = $request['mobile_number'];
        $insert_data = UserAocDetail::Create($data);

        if (isset($insert_data->id) && !empty($insert_data->id)) {
            $data['insert_id'] = $insert_data->id;
            $data['payment_purpose'] = 'Payment for AOC Register';
            $data['payment_amount'] = PaymentValue::where('id', 28)->first()->value;
            $data['name_of_pan'] = $data['name_of_company'];
            $data['type'] = 'Aoc';
            $data['route'] = 'aoc.register';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/aoc/register')->with('success', 'Registered Aoc successfully!');
    }

}
