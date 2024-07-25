<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\LoanFinance\CMA;
use App\Models\LoanFinance\Estimated;
use App\Models\LoanFinance\ProjectReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class LoanDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request, $userId)
    {
        $data['user'] = User::where('id', $userId)->first();
        $data['routeurl'] = Helper::getBaseUrl($request);
        $data['estimated'] = Estimated::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['cma'] = CMA::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['projectReport'] = ProjectReport::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        return view('admin.pages.users.loan.dashboard')->with($data);
    }

    public function profile($userId)
    {
        $data['userId'] = $userId;
        return view('admin.pages.users.profile')->with($data);
    }

    public function allProfile($name, $Id)
    {
        if ($name == 'cma') {
            $data['cmaDetails'] = CMA::find($Id);
            $data['cmaDocuments'] = Documents::where(['for_multiple' => 'LFCMA'])->get();
        }

        if ($name == 'estimated') {
            $data['estimatedDetails'] = Estimated::find($Id);
            $data['estimatedDocuments'] = Documents::where(['for_multiple' => 'LF Estimated'])->get();
        }

        if ($name == 'projectReport') {
            $data['projectReportDetails'] = ProjectReport::find($Id);
            $data['projectReportDocuments'] = Documents::where(['for_multiple' => 'LFPR'])->get();
        }

        $page['profilePage'] = $name;

        return view('admin.pages.users.loan.profile.all_profiles')->with($data)->with($page);
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
                    return redirect('/admin/user/loan-finance/details/' . $id)->with('filenotexist', 'File Not Exist!');
                }
            }
        } else {
            if (!empty ($files)) {
                $filePath = $folderPath . $files;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($files), $fileContents);
                } else {
                    return redirect('/admin/user/loan-finance/details/' . $id)->with('filenotexist', 'File Not Exist!');
                }
            } else {
                return redirect('/admin/user/loan-finance/details/' . $id)->with('filenotexist', 'File Not Exist!');
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

                if ($formtype == "CMA") {
                    $details = CMA::find($id);
                } else if ($formtype == "LFEstimated") {
                    $details = Estimated::find($id);
                }
                if ($formtype == "LFProjectReport") {
                    $details = ProjectReport::find($id);
                }

                $content = '<label>Number</label>
                <input type="text" class="form-control" name="company_number"  required="required" value=""  placeholder="Enter the  Number" />
                <label>Name of Company</label>
                <input type="text"  required="required" class="form-control" id="nameoftan" name="name" value="' . $details->name . '"  placeholder="Name" />';

                if (isset ($details)) {
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
            case "CMA":
                $panid = $request->id;
                $datas = CMA::find($panid);
                $fName = "CMA";
                break;

            case "LFEstimated":
                $panid = $request->id;
                $datas = Estimated::find($panid);
                $fName = "LFEstimated";
                break;

            case "LFProjectReport":
                $panid = $request->id;
                $datas = ProjectReport::find($panid);
                $fName = "LFProjectReport";
                break;

            default:
                break;
        }
        $folderNameChange = ($request->type == 'approve') ? '//LoanFinance/' . $fName . '/ApprovedImg' : '//LoanFinance/' . $fName . '/RaisedImg';
        $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
        // $panid = $request->id;
        // $datas = UserPanDetail::find($panid);
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
        return redirect('admin/user/loan-finance/dashboard/details/' . $userId)->with('success', 'Uploaded the Document!');
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
                $filePath = 'public/uploads/users/' . $useName . '//LoanFinance/' . $formType . '/' . 'AdditionalImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('admin/user/loan-finance/dashboard/details/' . $userId)->with('additionalfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '//LoanFinance/' . $formType . '/' . 'AdditionalImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('admin/user/loan-finance/dashboard/details/' . $userId)->with('additionalfilenotexist', 'File Not Exist!');
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
                $filePath = 'public/uploads/users/' . $useName . '//LoanFinance/' . $formType . '/' . 'ApprovedImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('admin/user/loan-finance/dashboard/details/' . $userId)->with('approvedfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '//LoanFinance/' . $formType . '/' . 'ApprovedImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('admin/user/loan-finance/dashboard/details/' . $userId)->with('approvedfilenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }
}
