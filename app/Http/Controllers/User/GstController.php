<?php
namespace App\Http\Controllers\User;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\CopyOfReturns;
use App\Models\Documents;
use App\Models\GstFormType;
use App\Models\PaymentValue;
use App\Models\UserDirector;
use App\Models\UserGstDetail;
use App\Models\UserGstUploadDocument;
use App\Models\UserPartner;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class GstController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //  \DB::enableQueryLog();
        $userId = auth()->user()->id;
        $data['userGstDetails'] = UserGstDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->get()->first();
        $data['userGstApprovedDetails'] = UserGstDetail::whereIn('status', [4])->where('user_id', $userId)->get()->first();
        //   dd(\DB::getQueryLog());
        //   dd($data);
        return view('user.pages.gst.details')->with($data);
    }
    public function register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserGstDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Gst';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Gst and Payment received successfully!';
            } else {
                $msg = 'Registered Gst successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/gst/register')->with('success', $msg);
        }
        $data['images'] = Documents::where(['for_multiple' => 'GST'])->get();
        $data['firm_images'] = Documents::where(['for_multiple' => 'GST Firm'])->get();
        $data['firm_partner_images'] = Documents::where(['for_multiple' => 'GST Firm Partner'])->get();
        $data['company_images'] = Documents::where(['for_multiple' => "GST Company"])->get();
        $data['company_director_images'] = Documents::where(['for_multiple' => 'GST Company Director'])->get();
        $data['amount'] = PaymentValue::where('id', 1)->first()->value;
        $data['amount_fi'] = PaymentValue::where('id', 2)->first()->value;
        $data['amount_ci'] = PaymentValue::where('id', 3)->first()->value;
        return view('user.pages.gst.form')->with($data);
    }

    public function existing_register_form()
    {
        if (isset($_REQUEST["payment_id"]) && !empty($_REQUEST["payment_request_id"])) {
            UserGstDetail::where('payment_unique_id', '=', $_REQUEST["payment_request_id"])->update(array('payment_status' => $_REQUEST["payment_status"]));
            $response = $_REQUEST;
            $response['userid'] = auth()->user()->id;
            $response['type'] = 'Gst';
            Helper::storePaymentResponse($response);

            if ($_REQUEST["payment_status"] == 'Credit') {
                $msg = 'Registered Gst and Payment received successfully!';
            } else {
                $msg = 'Registered Gst successfully! but we are unable to complete payment transaction. Please visit Dashboard to initiate the payment again.';
            }
            return redirect('/gst/register')->with('success', $msg);
        }
        $data['images'] = Documents::where(['for_multiple' => 'GST'])->get();
        $data['firm_images'] = Documents::where(['for_multiple' => 'GST Firm'])->get();
        $data['firm_partner_images'] = Documents::where(['for_multiple' => 'GST Firm Partner'])->get();
        $data['company_images'] = Documents::where(['for_multiple' => "GST Company"])->get();
        $data['company_director_images'] = Documents::where(['for_multiple' => 'GST Company Director'])->get();
        $data['amount'] = PaymentValue::where('id', 1)->first()->value;
        $data['amount_fi'] = PaymentValue::where('id', 2)->first()->value;
        $data['amount_ci'] = PaymentValue::where('id', 3)->first()->value;

        return view('user.pages.gst.existing_form')->with($data);
    }

    public function storeExistingRegister(Request $request)
    {
        $messages = [
            'gst_number.unique' => 'The GST Number is already exists.',
        ];
        $validatedData = $request->validate([
            'gst_number' => 'required|unique:users_gst_details',
        ], $messages);
        $userId = auth()->user()->id;
        $useName = $userId;
        $data['user_id'] = $userId;
        $data['trade_name'] = $request['trade_name'];
        $data['email_id'] = $request['email_id'];
        $data['gst_number'] = $request['gst_number'];
        $data['type'] = 'Existing GST registration';
        $data['gst_id'] = $request['gst_id'];
        $data['status'] = 4;
        $data['gst_password'] = $request['gst_password'];
        UserGstDetail::Create($data);
        return redirect('/gst/existing_register')->with('success', 'Existing Registered successfully!');
    }

    public function uploadAllImages($request, $userId, $gst_type_val, $folderName)
    {
        $userFolder = $folderName;
        if (!File::exists($userFolder)) {
            File::makeDirectory($userFolder, 0777, true, true);
        }
        $allimages = Documents::where('gst_type_val', $gst_type_val)->get();
        $data = [];
        foreach ($allimages as $img) {
            $keyname = $img['doc_key_name'];
            $imgName = str_replace(' ', '', $img['doc_name']);
            if ($request->hasFile($keyname)) {
                $images = $request->file($keyname);
                $related_imgs = [];
                foreach ($images as $index => $image) {
                    $newName = $imgName . '_' . ($index + 1) . '_' . time() . '.' . $image->getClientOriginalExtension();
                    $path = $image->move($userFolder, $newName);
                    $related_imgs[] = $newName;
                }
                $data[$keyname] = implode(',', $related_imgs);
            }
        }
        return $data;
    }

    protected function checkExist($value)
    {
        $userId = auth()->user()->id;
        $matchthese = ['user_id' => $userId, 'gst_type' => $value];
        $result = UserGstDetail::where($matchthese)->get();
        if (count($result) > 0) {
            return true;
        }
    }
    public function validateform($request)
    {

        $gstType = $request['gst_type'];

        $validatedData = $request->validate([
            'gst_type' => ['required', function ($attribute, $value, $fail) {
                $messages = 'You have already applies for GST New Registration as ' . $value;
                $isExist = $this->checkExist($value);
                if ($isExist) {
                    $fail($messages);
                }
            }],
        ]);
    }
    public function storeIndividual(Request $request)
    {
        // $this->validateform($request);
        $userId = auth()->user()->id;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Gst/Individual';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'GST');
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['gst_type'] = $request['gst_type'];
        $data['trade_name'] = $request['trade_name'];
        $data['status'] = 1; //1- Under Process/2- Query Raised/ 3- Query Updated, 4-Approved
        $matchthese = ['user_id' => $userId, 'gst_type' => 'Individual'];
        $lastInsertedId = UserGstDetail::updateOrCreate($matchthese, $data)->id;

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for GST Register';
            $data['name_of_pan'] = $data['trade_name'];
            $data['email_id'] = $data['email_id'];
            $data['mobile_number'] = (!empty($request['mobile_linked_aadhar']) ? $request['mobile_linked_aadhar'] : '7218046496');
            $data['payment_amount'] = PaymentValue::where('id', 1)->first()->value;
            $data['type'] = 'Gst';
            $data['route'] = 'gst.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        return redirect('/gst/register')->with('success', 'Registered as Individual successfully!');
    }
    public function storeFirm(Request $request)
    {
        // $this->validateform($request);
        $userId = auth()->user()->id;
        $dataon = 'partners';
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Gst/Firm';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'GST Firm');
        // $data =  $this->uploadAllImages($request,$userId,2,$folderName);
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['gst_type'] = $request['gst_type'];
        $data['trade_name'] = $request['trade_name'];
        $data['status'] = 1;
        $matchthese = ['user_id' => $userId, 'gst_type' => 'Firm'];
        $lastInsertedId = UserGstDetail::updateOrCreate($matchthese, $data)->id;
        
        if ($request->has('partners')) {
            $partners = $request->input('partners');
            foreach ($partners as $key => $ps) {
                $folderName = 'public/uploads/users/' . $useName . '/Gst/Firm/Partners';

                $partner = Helper::uploadAddMultipleImages($request, $key, $userId, $folderName, $dataon, 'GST Firm Partner');
                // $partner =  $this->uploadPartnerImages($request, $key, $userId,   $folderName,$dataon,'GST Firm Partner');
                $partner['user_gst_id'] = $lastInsertedId;
                $partner['user_id'] = $userId;
                $partner['partner_email'] = $ps['email'];
                $partner['partner_mobile'] = $ps['mobile'];
                UserPartner::Create($partner);
            }
        }

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for GST Register';
            $data['name_of_pan'] = $data['trade_name'];
            $data['email_id'] = $data['email_id'];
            $data['mobile_number'] = (!empty($request['mobile_linked_aadhar']) ? $request['mobile_linked_aadhar'] : '7218046496');
            $data['payment_amount'] = PaymentValue::where('id', 2)->first()->value;
            $data['type'] = 'Gst';
            $data['route'] = 'gst.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }

        return redirect('/gst/register')->with('success', 'Registered as Firm successfully!');
    }

    public function uploadPartnerImages($request, $key, $userId, $gst_type_val, $folderName, $dataon, $for_partner_director)
    {

        $userFolder = $folderName;
        if (!File::exists($userFolder)) {
            File::makeDirectory($userFolder, 0777, true, true);
        }
        $allimages = Documents::where(['gst_type_val' => $gst_type_val, 'for_partner_director' => $for_partner_director])->get();

        foreach ($allimages as $img) {
            if ($request->file($dataon)) {
                $keyname = $img['doc_key_name'];
                $imgName = str_replace(' ', '', $img['doc_name']);
                $images = $request->file($dataon)[$key];
                $related_imgs = [];
                if (isset($images[$keyname])) {
                    foreach ($images[$keyname] as $index => $p) {
                        $newName = $imgName . '_' . ($index + 1) . '_' . ($key) . '_' . time() . '.' . $p->getClientOriginalExtension();
                        $imagePath = $p->move($folderName, $newName);
                        $related_imgs[] = $newName;
                    }
                }

            }
            $data[$keyname] = implode(',', $related_imgs);
        }
        return $data;
    }

    public function storeCompany(Request $request)
    {
        $this->validateform($request);
        $userId = auth()->user()->id;
        $dataon = 'directors';
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Gst/Company';
        $data = Helper::uploadImagesNew($request, $userId, $folderName, 'GST Company');
        // $data =  $this->uploadAllImages($request,$userId,2,$folderName);
        $data['user_id'] = $userId;
        $data['email_id'] = $request['email_id'];
        $data['gst_type'] = $request['gst_type'];
        $data['trade_name'] = $request['trade_name'];
        $data['status'] = 1;
        $matchthese = ['user_id' => $userId, 'gst_type' => 'Company'];
        $lastInsertedId = UserGstDetail::updateOrCreate($matchthese, $data)->id;
        
        if ($request->has('directors')) {
            $directors = $request->input('directors');
            foreach ($directors as $key => $ds) {
                $folderName = 'public/uploads/users/' . $useName . '/Gst/Company/Directors';
                $director = Helper::uploadAddMultipleImages($request, $key, $userId, $folderName, $dataon, 'GST Company Director');
                // $director =  $this->uploadPartnerImages($request, $key, $userId, 3, $folderName,$dataon,2);
                $director['user_gst_id'] = $lastInsertedId;
                $director['user_id'] = $userId;
                $director['director_email'] = $ds['email'];
                $director['director_mobile'] = $ds['mobile'];
                UserDirector::Create($director);
            }
        }

        if (isset($lastInsertedId) && !empty($lastInsertedId)) {
            $data['insert_id'] = $lastInsertedId;
            $data['payment_purpose'] = 'Payment for GST Register';
            $data['name_of_pan'] = $data['trade_name'];
            $data['email_id'] = $data['email_id'];
            $data['mobile_number'] = (!empty($request['mobile_linked_aadhar']) ? $request['mobile_linked_aadhar'] : '7218046496');
            $data['payment_amount'] = PaymentValue::where('id', 3)->first()->value;
            $data['type'] = 'Gst';
            $data['route'] = 'gst.register_form';
            $payment_Req = Helper::createInstaMojoOrder($data);
        }
        
        return redirect('/gst/register')->with('success', 'Registered as Company successfully!');
    }

    public function businessStatus(Request $request)
    {
        $userId = auth()->user()->id;
        $data['userGstDetails'] = UserGstDetail::whereIn('status', [1, 2, 3, 4])->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['userUploadeDocuments'] = UserGstUploadDocument::where('user_id', $userId)->orderBy('id', 'DESC')->paginate(5);
        return view('user.pages.gst.business_status')->with($data);
    }

    public function uploadDocumentsCreate(Request $request)
    {
        $userId = auth()->user()->id;
        $useName = $userId;
        $gstId = UserGstDetail::where('gst_number', $request->input('gstnumber'))->where('user_id', $userId)->first();

        if ($request->input('gstnumber') && $request->input('doc_type') == 'Monthly') {
            // $gstId = $request->input('gstid');

            $folderName = 'public/uploads/users/' . $useName . '/Gst/UploadDocuments/Monthly';
            $data = Helper::uploadImagesNormal($request, $userId, $folderName, 'documents');
            $data['gst_id'] = $gstId->id;
            $data['user_id'] = $userId;
            $data['year'] = $request->input('year');
            $data['month'] = $request->input('month');
            $data['doc_type'] = 'Monthly';
            // $matchthese = ['user_id'=>$userId, 'doc_type'=>'Monthly', 'gst_id' => $gstId, 'year' =>$request->input('year')  ];
            // UserGstUploadDocument::where($matchthese)->delete();
            $lastInsertedId = UserGstUploadDocument::updateOrCreate($data)->id;
            $msg = 'Monthly - Upload Documents Successfully Updated!';

        } else if ($request->input('gstnumber') && $request->input('doc_type') == 'Quarterly') {

            $useName = $userId;
            $folderName = 'public/uploads/users/' . $useName . '/Gst/UploadDocuments/Quarterly';
            $data = Helper::uploadImagesNormal($request, $userId, $folderName, 'documents');
            $data['gst_id'] = $gstId->id;
            $data['user_id'] = $userId;
            $data['year'] = $request->input('year');
            $data['quarter'] = $request->input('quarter');
            $data['doc_type'] = 'Quarterly';
            // $matchthese = ['user_id'=>$userId, 'doc_type'=>'Quarterly', 'gst_id' => $gstId  ];
            // UserGstUploadDocument::where($matchthese)->delete();
            $lastInsertedId = UserGstUploadDocument::updateOrCreate($data)->id;
            $msg = 'Quarterly - Upload Documents Successfully Updated!';

        }
        return redirect('/gst/uploaddocuments')->with('success', $msg);

    }

    public function uploadDocuments(Request $request)
    {
        $data['routeUrl'] = Helper::getBaseUrl($request);

        $userId = auth()->user()->id;
        $data['settings'] = UserSetting::select('value')->where(['user_id' => $userId, 'type' => 'Upload Document', 'status' => 1])->orderBy('id', 'DESC')->get();

        $data['gstNumbers'] = UserGstDetail::select('gst_number')->whereNotNull('gst_number')->where('user_id', $userId)->get();
        return view('user.pages.gst.uploadDocuments.index')->with($data);
    }

    public function getTradeName(Request $request)
    {
        $userId = auth()->user()->id;
        $gstNumber = $request->input('gst');
        $tradeName = UserGstDetail::select('id', 'trade_name')->where(['user_id' => $userId, 'gst_number' => $gstNumber])->get()->first();
        return response()->json($tradeName);
    }

    public function copyOfReturns(Request $request)
    {
        $routeUrl = Helper::getBaseUrl($request);
        $userId = auth()->user()->id;
        $formtypes = GstFormType::select('type')->get();
        $gstNumbers = UserGstDetail::select('gst_number')->whereNotNull('gst_number')->where('user_id', $userId)->get();
        $items = [];
        $selectedgstNumber = "";
        $selectedformtype = "";
        $selectedyear = "";
        $selectedmonth = "";
        $selectedquarter = "";
        if ($request->method() == 'POST') {

            $selectedgstNumber = $request->input('gstnumber');
            $selectedformtype = $request->input('formtype');
            $selectedyear = $request->input('year');
            $selectedmonth = $request->input('month');
            $selectedquarter = $request->input('quarter');

            $query = CopyOfReturns::query();
            if ($selectedgstNumber) {
                $query->where('gst_number', 'LIKE', '%' . $selectedgstNumber . '%');
            }

            if ($selectedformtype) {
                $query->where('form_type', $selectedformtype);
            }

            if ($selectedyear) {
                $query->where('year', $selectedyear);
            }

            if ($selectedmonth) {
                $query->where('month', $selectedmonth);
            }

            if ($selectedquarter) {
                $query->where('quarter', $selectedquarter);
            }

            $items = $query->get();

        }

        return view('user.pages.gst.copy_of_returns', compact('gstNumbers', 'formtypes', 'items',
            'selectedgstNumber', 'selectedformtype', 'selectedyear', 'selectedmonth', 'selectedquarter', 'routeUrl'));
    }

    public function getFormType(Request $request)
    {

        $userId = auth()->user()->id;
        $gstNumber = $request->input('gst');
        $getFormType = CopyOfReturns::select('form_type')->where(['user_id' => $userId, 'gst_number' => $gstNumber])->distinct('form_type')->get();
        return response()->json($getFormType);
    }

    public function getYear(Request $request)
    {
        $userId = auth()->user()->id;
        $gstNumber = $request->input('gst');
        $form_type = $request->input('formtype');
        $getYear = CopyOfReturns::select('year')->where(['user_id' => $userId, 'gst_number' => $gstNumber, 'form_type' => $form_type])->distinct('year')->get();
        return response()->json($getYear);
    }

    public function getMonth(Request $request)
    {
        $userId = auth()->user()->id;
        $gstNumber = $request->input('gst');
        $form_type = $request->input('formtype');
        $getYear = $request->input('gstyear');
        $getMonth = CopyOfReturns::select('month')->where(['user_id' => $userId, 'gst_number' => $gstNumber, 'form_type' => $form_type, 'year' => $getYear])->distinct('month')->get();
        return response()->json(($getMonth));
    }

    public function getQuarter(Request $request)
    {
        $userId = auth()->user()->id;
        $gstNumber = $request->input('gst');
        $form_type = $request->input('formtype');
        $getYear = $request->input('gstyear');
        $getmonth = $request->input('gstmonth');
        $getQuarter = CopyOfReturns::select('quarter')->where(['user_id' => $userId, 'gst_number' => $gstNumber, 'form_type' => $form_type, 'year' => $getYear, 'month' => $getmonth])->distinct('quarter')->get();
        return response()->json($getQuarter);
    }

    public function queryRaised(Request $request)
    {
        $userId = auth()->user()->id;
        $gstid = $request->gstid;
        $useName = $userId;
        $folderName = 'public/uploads/users/' . $useName . '/Gst/AdditionalImg';
        $name = 'additional_img';
        $img = Helper::uploadImagesNormal($request, $userId, $folderName, $name);

        $datas = UserGstDetail::find($gstid);

        $datas->user_note = $request->user_note;
        $datas->status = 3; // Query Updated
        $datas->last_update_by = 'user';
        $datas->last_update_by_id = $userId;
        $datas->additional_img = $img['additional_img'];
        $datas->save();
        return redirect('/gst/business')->with('success', 'Uploaded the Document!');
    }

    public function approvedFile(Request $request)
    {

        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $userId = auth()->user()->id;
        $useName = $userId;
        $zipName = 'QueryApprovedFile-' . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '/Gst/ApprovedImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('/gst/business')->with('approvedfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/Gst/ApprovedImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('/gst/business')->with('approvedfilenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);

        // $fileName = $request->input('files');
        // $userId = auth()->user()->id;
        // $useName = trim(auth()->user()->name).'-'.$userId;
        // $filePath = 'public/uploads/users/'.$useName.'/Gst/ApprovedImg/'.$fileName;
        // if (File::exists($filePath)) {
        //     $headers = [
        //         // 'Content-Type' => 'application/pdf',
        //         'Content-Type' => 'image/jpeg',
        //     ];
        //     return Response::download($filePath, $fileName,$headers);
        // } else {
        //     abort(404);
        // }
    }

    public function uploadDocumentFile(Request $request)
    {
        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $userId = auth()->user()->id;
        $doc_type = $request->doc_type;
        $useName = $userId;
        $zipName = $doc_type . '-' . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '/Gst/UploadDocuments/' . $doc_type . '/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('/gst/business')->with('danger', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/Gst/UploadDocuments/' . $doc_type . '/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('/gst/business')->with('filenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }

    public function copyofreturnsFile(Request $request)
    {
        $fileName = $request->input('files');
        $userId = auth()->user()->id;
        $useName = $userId;
        $filePath = 'public/uploads/users/' . $useName . '/Gst/CopyOfReturns/' . $fileName;

        if (File::exists($filePath)) {
            $headers = [
                // 'Content-Type' => 'application/pdf',
                'Content-Type' => 'image/jpeg',
            ];
            return Response::download($filePath, $fileName, $headers);
        } else {
            echo "File not found";
            abort(404);
        }
    }

    public function raisedFile(Request $request)
    {
        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $userId = auth()->user()->id;
        $useName = $userId;
        $zipName = 'QueryRaisedFile-' . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '/Gst/RaisedImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('/gst/business')->with('raisedfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/Gst/RaisedImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('/gst/business')->with('raisedfilenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }
}
