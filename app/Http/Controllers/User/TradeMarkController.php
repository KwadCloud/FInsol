<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserTrademarkDetail;
use App\Models\UserTrademarkSignatory;
use Illuminate\Http\Request;

class TradeMarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        echo "Detail page";
    }

    public function register_form()
    {
        if (isset ($_REQUEST["payment_id"]) && !empty ($_REQUEST["payment_request_id"])) {
            UserTrademarkDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Trademark';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Trademark and Payment received successfully!';
            } else {
                $msg = 'Registered Trademark successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/trademark/register')->with('success', $msg);
        }
        $data['trademark_company_images'] = Documents::where(['for_multiple' => 'TRADEMARK Company'])->get();
        $data['trademark_company_signatory_images'] = Documents::where(['for_multiple' => 'TRADEMARK Signatory'])->get();
        $data['trademark_other_images'] = Documents::where(['for_multiple' => 'TRADEMARK Others'])->get();
        $data['amount_trade_ci'] = PaymentValue::where('id', 14)->first()->value;
        $data['amount_trade_cs'] = PaymentValue::where('id', 8)->first()->value;
        $data['amount'] = PaymentValue::where('id', 41)->first()->value;
        return view('user.pages.trademark.trademarkform')->with($data);
    }

    public function storeTrademarkCompany(Request $request)
    {
        $dataon = 'trademarksignatory';
        $userId = auth()->user()->id;        
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Trademark/Company';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'TRADEMARK Company');
        $data['user_id'] = $userId;
        $data['trademark_type'] = $request['trademark_type'];
        $data['name_of_trademark'] = $request['name_of_trademark'];
        $data['trademark_email'] = $request['email_id'];
        $data['trademark_mobile'] = $request['mobile_number'];
        $data['name_of_business'] = $request['name_of_business'];
        $data['registration_type'] = $request->input('registration_type');
        $lastInsertedId = UserTrademarkDetail::updateOrCreate($data)->id;

        if ($request->has('trademarksignatory')) {
            $trademarksignatory = $request->input('trademarksignatory');
            foreach ($trademarksignatory as $key => $ps) {
                $folderName = 'public/uploads/users/' . $useName . '/Trademark/Company/Signatory';
                $partner = Helper::uploadSignatoryImages($request, $key, $userId, $folderName, $dataon, 'TRADEMARK Signatory');
                $partner['user_trademark_id'] = $lastInsertedId;
                $partner['user_id'] = $userId;
                $partner['trademark_sign_email'] = $ps['email'];
                $partner['trademark_sign_mobile'] = $ps['mobile'];
                UserTrademarkSignatory::updateOrCreate($partner);
            }
        }

        if (isset ($lastInsertedId) && !empty ($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Trademark Register';
            $data['name_of_pan'] = $data['name_of_trademark'];
            $data['email_id'] = $data['trademark_email'];
            $data['mobile_number'] = $data['trademark_mobile'];
            $data['payment_amount'] = PaymentValue::where('id', 8)->first()->value;
            $data['type'] = 'Trademark';
            $data['route'] = 'trademark.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/trademark/register')->with('success', 'Registered TRADEMARK successfully!');
    }

    public function storeTrademarkOthers(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Trademark/Others';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'TRADEMARK Others');
        $data['user_id'] = $userId;
        $data['trademark_email'] = $request['email_id'];
        $data['trademark_mobile'] = $request['mobile_number'];
        $data['trademark_type'] = $request['trademark_type'];
        $data['name_of_trademark'] = $request['name_of_trademark'];
        $data['name_of_business'] = $request['name_of_business'];
        $lastInsertedId = UserTrademarkDetail::updateOrCreate($data)->id;

        if (isset ($lastInsertedId) && !empty ($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Trademark Register';
            $data['name_of_pan'] = $data['name_of_trademark'];
            $data['email_id'] = $data['trademark_email'];
            $data['mobile_number'] = $data['trademark_mobile'];
            $data['payment_amount'] = PaymentValue::where('id', 41)->first()->value;
            $data['type'] = 'Trademark';
            $data['route'] = 'trademark.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        return redirect('/trademark/register')->with('success', 'Registered TRADEMARK Others successfully!');
    }
}
