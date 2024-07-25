<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\CopyOfReturns;
use App\Models\GstFormType;
use App\Models\User;
use App\Models\UserGstDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class CopyofreturnsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index($userId, Request $request)
    {
        $data['user'] = User::where('id', $userId)->first();
        $data['routeUrl'] = Helper::getBaseUrl($request);
        $data['copyofreturns'] = CopyOfReturns::where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['gstNumbers'] = UserGstDetail::select('gst_number')->whereNotNull('gst_number')->where('user_id', $userId)->get();
        $data['formTypes'] = GstFormType::select('type')->get();
        $data['userId'] = $userId;
        return view('admin.pages.copyofreturns.copyofreturnslist')->with($data);
    }

    public function getTradeName(Request $request)
    {
        $gstNumber = $request->input('gst');
        $tradeName = UserGstDetail::select('id', 'trade_name')->where(['gst_number' => $gstNumber])->get()->first();
        return response()->json($tradeName);
    }

    public function Create($userId, Request $request)
    {

        $userData = User::find($userId);
        $gstId = UserGstDetail::where('gst_number', $request->gstnumber)->where('user_id', $userId)->first();
        $useName = $userData->name . '-' . $userId;

        $folderName = 'public/uploads/users/' . $useName . '/Gst/CopyOfReturns';
        $data = Helper::uploadImagesNormal($request, $userId, $folderName, 'documents');
        $data['gst_number'] = $request->gstnumber;
        $data['user_gst_id'] = $request->gstid;
        $data['user_id'] = $userId;
        $data['form_type'] = $request->formtype;
        $data['trade_name'] = isset($gstId->trade_name) ? $gstId->trade_name : '';
        $data['year'] = $request->year;
        if ($request->doc_type == 'Monthly') {
            $data['month'] = isset($request->month) ? $request->month : '';
        } else {
            $data['quarter'] = isset($request->quarter) ? $request->quarter : '';
        }
        $lastInsertedId = CopyOfReturns::Create($data)->id;
        $msg = $request->input('doc_type') . ' Copy of return Successfully Added!';
        return redirect('/admin/user/gst/copyofreturns/' . $userId)->with('success', $msg);

    }
    public function delete($cpyd, Request $request)
    {
        $split = explode('-', $cpyd);
        $cpydId = $split[0];
        $userId = $split[1];
        $cpyof = CopyOfReturns::where('id', $cpydId)->delete();
        $msg = ' Deleted Successfully!';
        return redirect('/admin/user/gst/copyofreturns/' . $userId)->with('success_delete', $msg);
    }

    public function adminusercopyofreturnsFile(Request $request, $userId)
    {
        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $userDetails = User::find($userId);

        $form_type = $request->form_type;
        $useName = $userId;
        $zipName = $form_type . '-' . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '/Gst/CopyOfReturns/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('/admin/user/gst/copyofreturns/' . $userId)->with('filenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/Gst/CopyOfReturns/' . $files;

            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('/admin/user/gst/copyofreturns/' . $userId)->with('filenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }

}
