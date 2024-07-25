<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\PaymentValue;
use App\Models\UserFactoryLicenseDetail;
use Illuminate\Http\Request;

class FactoryLicenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        echo "asdads";
        //  return view('user.pages.gst.details');
    }
    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserFactoryLicenseDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Factory';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Factory License and Payment received successfully!';
            } else {
                $msg = 'Registered Factory License successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/factorylicense/register')->with('success', $msg);
        }
        $data['factory_license_images'] = Documents::where('for_multiple', 'FL')->get();
        $data['amount'] = PaymentValue::where('id', 24)->first()->value;
        return view('user.pages.factorylicense.factorylicenseform')->with($data);
    }

    public function storeFactoryLicense(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/FactoryLicense';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'FL');
        $data['user_id'] = $userId;
        $data['name_of_facl'] = $request['name_of_facl'];
        $data['facl_email'] = $request['facl_email'];
        $data['facl_mobile'] = $request['facl_mobile'];
        $data['registration_type'] = $request->input('registration_type');
        $lastInsertedId = UserFactoryLicenseDetail::Create($data)->id;
        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for Factory License Register';
            $data['name_of_pan'] = $data['name_of_facl'];
            $data['email_id'] = $data['facl_email'];
            $data['mobile_number'] = $data['facl_mobile'];
            $data['payment_amount'] = PaymentValue::where('id', 24)->first()->value;
            $data['type'] = 'Factory';
            $data['route'] = 'factorylicense.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        return redirect('/factorylicense/register')->with('success', 'Registered Factory License successfully!');
    }

}
