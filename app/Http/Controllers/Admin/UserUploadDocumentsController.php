<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGstUploadDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class UserUploadDocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request, $userId)
    {
        $data['user'] = User::where('id', $userId)->first();
        $data['routeUrl'] = Helper::getBaseUrl($request);
        $data['userUploadeDocuments'] = UserGstUploadDocument::where('user_id', $userId)->orderBy('id', 'DESC')->get();
        return view('admin.pages.users.uploaddocuments')->with($data);
    }

    public function change_approve(Request $request, $docId)
    {

        if (isset($docId)) {

            $UserGstUploadDocument = UserGstUploadDocument::find($docId);
            $userid = $UserGstUploadDocument->user_id;
            $UserGstUploadDocument->status = 2; //Approve Upload Documents
            $UserGstUploadDocument->save();
            return 1;
            // return redirect('admin/user/gst/uploaddocuments/'.$userId)->with('success', 'Approved the Document Successfuly!');
        }

    }

    public function adminuserUploadDocumentFile(Request $request, $userId)
    {
        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $userDetails = User::find($userId);

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
                    return redirect('user/gst/uploaddocuments/' . $userId)->with('danger', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/Gst/UploadDocuments/' . $doc_type . '/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('user/gst/uploaddocuments/' . $userId)->with('filenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }

}
