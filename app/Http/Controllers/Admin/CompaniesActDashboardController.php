<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\CompaniesAct\UserAdtDetail;
use App\Models\CompaniesAct\UserAocDetail;
use App\Models\CompaniesAct\UserDinkycDetail;
use App\Models\CompaniesAct\UserMgtDetail;
use App\Models\CompaniesAct\UserMinutesDetail;
use App\Models\CompaniesAct\UserStatutoryAuditDetail;
use App\Models\Documents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class CompaniesActDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request, $userId)
    {
        $data['user'] = User::where('id', $userId)->first();
        $data['routeurl'] = Helper::getBaseUrl($request);
        $data['usersMgt'] = UserMgtDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersAdt'] = UserAdtDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersAoc'] = UserAocDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersMinutes'] = UserMinutesDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersDinkyc'] = UserDinkycDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersStatutoryaudit'] = UserStatutoryAuditDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();

        return view('admin.pages.users.companiesact.companiesact_dashboard')->with($data);
    }

    public function profile($userId)
    {
        $data['userId'] = $userId;
        return view('admin.pages.users.profile')->with($data);
    }

    public function allProfile($name, $Id)
    {
        if ($name == 'mgt') {
            $data['mgtDetails'] = UserMgtDetail::find($Id);
            $data['mgtDocuments'] = Documents::where(['for_multiple' => 'MGT'])->get();
        }

        if ($name == 'aoc') {
            $data['aocDetails'] = UserAocDetail::find($Id);
            $data['aocDocuments'] = Documents::where(['for_multiple' => 'AOC'])->get();
        }

        if ($name == 'adt') {
            $data['adtDetails'] = UserAdtDetail::find($Id);
            $data['adtDocuments'] = Documents::where(['for_multiple' => 'ADT'])->get();
        }

        if ($name == 'minutes') {
            $data['minutesDetails'] = UserMinutesDetail::find($Id);
            $data['minutesDocuments'] = Documents::where(['for_multiple' => 'MINUTES'])->get();
        }

        if ($name == 'dinkyc') {
            $data['dinkycDetails'] = UserDinkycDetail::find($Id);
            $data['dinkycDocuments'] = Documents::where(['for_multiple' => 'DINKYC'])->get();
        }

        if ($name == 'statutoryaudit') {
            $data['statutoryauditDetails'] = UserStatutoryAuditDetail::find($Id);
            $data['statutoryauditDocuments'] = Documents::where(['for_multiple' => 'SA'])->get();
        }

        $page['profilePage'] = $name;

        return view('admin.pages.users.companiesact.profile.all_profiles')->with($data)->with($page);
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
                    return redirect('/admin/user/companiesact/details/' . $id)->with('filenotexist', 'File Not Exist!');
                }
            }
        } else {
            if (!empty($files)) {
                $filePath = $folderPath . $files;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($files), $fileContents);
                } else {
                    return redirect('/admin/user/companiesact/details/' . $id)->with('filenotexist', 'File Not Exist!');
                }
            } else {
                return redirect('/admin/user/companiesact/details/' . $id)->with('filenotexist', 'File Not Exist!');
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

                if ($formtype == "mgt") {

                    $details = UserMgtDetail::find($id);

                } else if ($formtype == "aoc") {
                    $details = UserAocDetail::find($id);
                }
                if ($formtype == "adt") {
                    $details = UserAdtDetail::find($id);
                }
                if ($formtype == "dinkyc") {
                    $details = UserDinkycDetail::find($id);
                }
                if ($formtype == "statutoryaudit") {
                    $details = UserStatutoryAuditDetail::find($id);
                }

                if ($formtype == "minutes") {
                    $details = UserMinutesDetail::find($id);
                }

                $content = '<label>Company Number</label>
            <input type="text" class="form-control" name="company_number"  required="required" value=""  placeholder="Enter the Company Number" />
            <label>Name of Company</label>
            <input type="text"  required="required" class="form-control" id="nameoftan" name="name_of_company" value="' . $details->name_of_company . '"  placeholder="Name of Company" />';

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
        $userDetails = User::find($userId);
        $useName = $userId;
        $route = $request->routeis;
        $fName = "";
        switch ($route) {
            case "statutoryaudit":
                $panid = $request->id;
                $datas = UserStatutoryAuditDetail::find($panid);
                $fName = "StatutoryAudit";
                break;

            case "dinkyc":
                $panid = $request->id;
                $datas = UserDinkycDetail::find($panid);
                $fName = "Dinkyc";
                break;

            case "mgt":
                $panid = $request->id;
                $datas = UserMgtDetail::find($panid);
                $fName = "Mgt";
                break;

            case "adt":
                $panid = $request->id;
                $datas = UserAdtDetail::find($panid);
                $fName = "Adt";
                break;

            case "aoc":
                $panid = $request->id;
                $datas = UserAocDetail::find($panid);
                $fName = "Aoc";
                break;

            case "minutes":
                $panid = $request->id;
                $datas = UserMinutesDetail::find($panid);
                $fName = "Minutes";
                break;
            default:break;
        }
        $folderNameChange = ($request->type == 'approve') ? '//CompaniesAct/' . $fName . '/ApprovedImg' : '//CompaniesAct/' . $fName . '/RaisedImg';
        $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
        // $panid = $request->id;
        // $datas = UserPanDetail::find($panid);
        $status = ($request->type == 'approve') ? 4 : 2;
        $datas->last_update_by = 'admin';
        $datas->status = $status; // Approved
        if ($request->type == 'approve') {
            $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
            $datas->name_of_company = $request->name_of_company;
            $datas->company_number = $request->company_number;
            $datas->approved_img = $img['approved_img'];
        } else {
            $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
            $datas->admin_note = $request->admin_note;
            $datas->raised_img = $img['raised_img'];
        }
        $datas->save();
        return redirect('admin/user/companiesact/dashboard/details/' . $userId)->with('success', 'Uploaded the Document!');
    }

    // download quary updated file
    public function additionalFile(Request $request, $userId)
    {
        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $userDetails = User::find($userId);
        $formType = $request->form_type;

        $useName = $userId;
        $zipName = $formType . "QueryUpdatedFile-" . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '//CompaniesAct/' . $formType . '/' . 'AdditionalImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('admin/user/companiesact/dashboard/details/' . $userId)->with('additionalfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '//CompaniesAct/' . $formType . '/' . 'AdditionalImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('admin/user/companiesact/dashboard/details/' . $userId)->with('additionalfilenotexist', 'File Not Exist!');
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
        $userDetails = User::find($userId);
        $formType = $request->form_type;

        $useName = $userId;
        $zipName = $formType . "ApprovedFile-" . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '//CompaniesAct/' . $formType . '/' . 'ApprovedImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('admin/user/companiesact/dashboard/details/' . $userId)->with('approvedfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '//CompaniesAct/' . $formType . '/' . 'ApprovedImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('admin/user/companiesact/dashboard/details/' . $userId)->with('approvedfilenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }
}
