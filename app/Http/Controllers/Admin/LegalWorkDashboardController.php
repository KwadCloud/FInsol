<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\LegalWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Helpers\Helper as Helper;
use App\Models\User;
use App\Models\Documents;

class LegalWorkDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request, $userId)
    {
        $data['user'] = User::where('id', $userId)->first();
        $data['routeurl'] = Helper::getBaseUrl($request);
        $data['legal'] = LegalWork::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        
        return view('admin.pages.users.legalWork.dashboard')->with($data);
    }

    public function profile($userId)
    {
        $data['userId'] = $userId;
        return view('admin.pages.users.profile')->with($data);
    }

    public function allProfile( $Id)
    {
        $data['details'] = LegalWork::find($Id);
        $data['documents'] = Documents::where(['for_multiple' => 'LEGALWORK'])->get();

        //$page['profilePage'] = $name;

        return view('admin.pages.users.legalWork.profile.all_profiles')->with($data);
    }

    public function allProfileDocDownload(Request $request, $userId)
    {
        $files = $request->input('files');
        $id = $request->input('id');
        $commaValues = explode(",", $files);
        $formType = $request->input('form_type');
        $useName = $userId;
        $zipName = str_replace('/', '-', $formType) . '-' . $useName . '.zip';
        $folderPath = 'public/uploads/users/' . $useName . '/' . $formType . '/';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = $folderPath . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('/admin/user/legal-work/details/' . $id)->with('filenotexist', 'File Not Exist!');
                }
            }
        } else {
            if (!empty($files)) {
                $filePath = $folderPath . $files;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($files), $fileContents);
                } else {
                    return redirect('/admin/user/legal-work/details/' . $id)->with('filenotexist', 'File Not Exist!');
                }
            } else {
                return redirect('/admin/user/legal-work/details/' . $id)->with('filenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }

    public function statusview(Request $request)
    {
        $for = $request->input('for');
        $formtype = $request->input('formtype');
        $id = $request->input('id');
        $details = "";
        $modalBody = "";
        $content = "";

        try {
            if ($formtype) {

                $details = LegalWork::find($id);

                $content = '<label>Number</label>
            <input type="text" class="form-control" name="company_number"  required="required" value=""  placeholder="Enter the  Number" />
            <label>Name of Company</label>
            <input type="text"  required="required" class="form-control" id="nameoftan" name="name" value="' . $details->name . '"  placeholder="Name" />';

                if (isset($details)) {
                    if ($for === 'note') {
                        $modalBody =
                        '<input type="hidden" name="userid" id="userid" value="' . $details->user_id . '" />
                <input type="hidden" id="id" name="id" value="' . $details->id . '" />
                <input type="hidden" name="routeis" id="routeis" value="' . $formtype . '" />
                <input type="hidden" name="type" value="note" />';
                    } else {
                        $modalBody =
                        '<input type="hidden" name="userid" id="userid" value="' . $details->user_id . '" />
                 <input type="hidden" id="id" name="id" value="' . $details->id . '" />
                 <input type="hidden" name="routeis" value="' . $formtype . '" />
                 <input type="hidden" name="type" value="approve" />';

                        $modalBody .= $content;
                    }
                }
                return response()->json(['modalBody' => $modalBody]);
            }
        } catch (\Exception $e) {
            // Log::error('An error occurred: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred. Please try again later.');
        }
    }

    // change note to quary raised, and query updated to approve
    public function change_status(Request $request)
    {
        $userId = $request->userid;
        $useName = $userId;
        $panid = $request->id;
        $datas = LegalWork::find($panid);
        $fName = "LegalWork";

        $folderNameChange = ($request->type == 'approve') ? '/' . $fName . '/ApprovedImg' : '/' . $fName . '/RaisedImg';
        $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
        $status = ($request->type == 'approve') ? 4 : 2;
        $datas->last_update_by = 'admin';
        $datas->status = $status; // Approved
        if ($request->type == 'approve') {
            $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
            $datas->name = $request->name;
            $datas->company_number = $request->company_number;
            $datas->approved_img = $img['approved_img'];
        } else {
            $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
            $datas->admin_note = $request->admin_note;
            $datas->raised_img = $img['raised_img'];
        }
        $datas->save();
        return redirect('admin/user/legal-work/dashboard/details/' . $userId)->with('success', 'Uploaded the Document!');
    }

    // download quary updated file
    public function additionalFile(Request $request, $userId)
    {
        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $formType = $request->form_type;

        $useName = $userId;
        $zipName = $formType . "QueryUpdatedFile-" . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'AdditionalImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('admin/user/legal-work/dashboard/details/' . $userId)->with('additionalfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'AdditionalImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('admin/user/legal-work/dashboard/details/' . $userId)->with('additionalfilenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }

    // download approved file for admin
    public function approvedFile(Request $request, $userId)
    {
        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $formType = $request->form_type;

        $useName = $userId;
        $zipName = $formType . "ApprovedFile-" . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'ApprovedImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('admin/user/legal-work/dashboard/details/' . $userId)->with('approvedfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'ApprovedImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('admin/user/legal-work/dashboard/details/' . $userId)->with('approvedfilenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }
}
