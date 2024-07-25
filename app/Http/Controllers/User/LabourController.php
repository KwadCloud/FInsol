<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserLabourDetail;
use App\Models\UserLabourSignatory;
use Illuminate\Http\Request;

class LabourController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserLabourDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Labour';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Labour and Payment received successfully!';
            } else {
                $msg = 'Registered Labour successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/labour/register')->with('success', $msg);
        }
        $data['petty_images'] = Documents::where(['for_multiple' => 'Petty Contract'])->get();
        $data['petty_signatory_images'] = Documents::where(['for_multiple' => 'Petty Contract Signatory'])->get();
        $data['labour_images'] = Documents::where(['for_multiple' => 'Labour Contract'])->get();
        $data['amount_sign'] = PaymentValue::where('id', 16)->first()->value;
        $data['amount'] = PaymentValue::where('id', 15)->first()->value;
        return view('user.pages.labour.labourform')->with($data);
    }

    public function storePetty(Request $request)
    {
        $userId = auth()->user()->id;
        $dataon = 'laboursignatory';
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Labour/Petty';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'Petty Contract');
        $data['user_id'] = $userId;
        $data['labour_type'] = $request['labour_type'];
        $data['name_of_labour'] = $request['name_of_labour'];
        $data['labour_email'] = $request['email_id'];
        $data['labour_mobile'] = $request['mobile_number'];
        $data['name_of_business'] = $request['name_of_business'];
        $data['registration_type'] = $request->input('registration_type');
        $lastInsertedId = UserLabourDetail::updateOrCreate($data)->id;
        
        if ($request->has('laboursignatory')) {
            $laboursignatory = $request->input('laboursignatory');
            
            foreach ($laboursignatory as $key => $ps) {
                $folderName = 'public/uploads/users/' . $useName . '/Labour/Petty/Signatory';
                $partner = Helper::uploadSignatoryImages($request, $key, $userId, $folderName, $dataon, 'Petty Contract Signatory');
                $partner['user_labour_id'] = $lastInsertedId;
                $partner['user_id'] = $userId;
                $partner['labour_sign_email'] = $ps['email'];
                $partner['labour_sign_mobile'] = $ps['mobile'];
                UserLabourSignatory::Create($partner);
            }
        }

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Labour Register';
            $data['name_of_pan'] = $data['name_of_labour'];
            $data['email_id'] = $data['labour_email'];
            $data['mobile_number'] = $data['labour_mobile'];
            $data['payment_amount'] = PaymentValue::where('id', 16)->first()->value;
            $data['type'] = 'Labour';
            $data['route'] = 'labour.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        
        return redirect('/labour/register')->with('success', 'Registered Petty Contractor successfully!');
    }

    public function storeLabour(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Labour/Labour';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'Labour Contract');
        $data['user_id'] = $userId;
        $data['labour_email'] = $request['email_id'];
        $data['labour_mobile'] = $request['mobile_number'];
        $data['labour_type'] = $request['labour_type'];
        $data['name_of_labour'] = $request['name_of_labour'];
        $data['name_of_business'] = $request['name_of_business'];
        $data['registration_type'] = $request->input('registration_type');
        $lastInsertedId = UserLabourDetail::Create($data)->id;

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Labour Register';
            $data['name_of_pan'] = $data['name_of_labour'];
            $data['email_id'] = $data['labour_email'];
            $data['mobile_number'] = $data['labour_mobile'];
            $data['payment_amount'] = PaymentValue::where('id', 15)->first()->value;
            $data['type'] = 'Labour';
            $data['route'] = 'labour.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        return redirect('/labour/register')->with('success', 'Registered Labour Contractor successfully!');
    }
}
