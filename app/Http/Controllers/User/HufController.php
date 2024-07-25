<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserHufDetail;
use App\Models\UserHufMember;
use Illuminate\Http\Request;

class HufController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserHufDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Huf';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Huf and Payment received successfully!';
            } else {
                $msg = 'Registered Huf successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/huf/register')->with('success', $msg);
        }

        $data['huf_member_images'] = Documents::where(['for_multiple' => 'HUF Member'])->get();
        $data['amount'] = PaymentValue::where('id', 11)->first()->value;
        return view('user.pages.huf.hufform')->with($data);
    }

    public function storeHuf(Request $request)
    {
        $userId = auth()->user()->id;
        $dataon = 'hufmember';
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Huf';
        $data['user_id'] = $userId;
        $data['name_of_huf'] = $request->input('name_of_huf');
        $data['name_of_karta'] = $request->input('name_of_karta');
        $data['huf_email'] = $request->input('huf_email');
        $data['huf_mobile'] = $request->input('huf_mobile');
        $data['registration_type'] = $request->input('registration_type');
        $lastInsertedId = UserHufDetail::Create($data)->id;
        
        if ($request->has('hufmember')) {
            $hufmember = $request->input('hufmember');
            foreach ($hufmember as $key => $ps) {
                $folderName = 'public/uploads/users/' . $useName . '/Huf/Member';
                $partner = Helper::uploadAddMultipleImages($request, $key, $userId, $folderName, $dataon, 'HUF Member');
                $partner['user_huf_id'] = $lastInsertedId;
                $partner['user_id'] = $userId;
                $partner['name_of_member'] = $ps['name_of_member'];
                
                UserHufMember::Create($partner);
            }
        }

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Huf Register';
            $data['name_of_pan'] = $data['name_of_huf'];
            $data['email_id'] = $data['huf_email'];
            $data['mobile_number'] = $data['huf_mobile'];
            $data['payment_amount'] = PaymentValue::where('id', 11)->first()->value;
            $data['type'] = 'Huf';
            $data['route'] = 'huf.paymentregister';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        
        return redirect('/huf/register')->with('success', 'Registered Huf successfully!');
    }

}
