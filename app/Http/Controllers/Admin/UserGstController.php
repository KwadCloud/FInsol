<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\User;
use App\Models\UserDirector;
use App\Models\UserGstDetail;
use App\Models\UserPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class UserGstController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

        // View::share('action', 'no_add');
        // View::share('nav', 'users');
    }

    public function index(Request $request, $userId)
    {
        $data['user'] = User::where('id', $userId)->first();
        $data['routeurl'] = Helper::getBaseUrl($request);
        $data['usersGst'] = UserGstDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        return view('admin.pages.users.gst')->with($data);
    }

    public function profile($userId)
    {
        $data['user'] = User::where('id', $userId)->first();
        $data['userId'] = $userId;
        return view('admin.pages.users.profile')->with($data);
    }

    public function gstProfile($gstId)
    {
        $data['gstDetails'] = UserGstDetail::find($gstId);
        $data['gstIndividualDocuments'] = Documents::where(['for_multiple' => 'GST'])->get();

        $data['gstFirmDocuments'] = Documents::where(['for_multiple' => 'GST Firm'])->get();
        $data['gstFirmPartnersDocuments'] = Documents::where(['for_multiple' => 'GST Firm Partner'])->get();

        $data['gstCompanyDocuments'] = Documents::where(['for_multiple' => 'GST Company'])->get();
        $data['gstCompanyDirectorsDocuments'] = Documents::where(['for_multiple' => 'GST Firm Partner'])->get();

        $data['gstFirmPartners'] = UserPartner::where(['user_gst_id' => $gstId])->get();

        $data['gstCompanyDirectors'] = UserDirector::where(['user_gst_id' => $gstId])->get();

        return view('admin.pages.users.gst.gstprofile')->with($data);
    }

    public function downloadGstFile(Request $request, $userId)
    {
        $files = $request->input('files');

        $gstId = $request->input('gst_id');
        $gst_type = $request->input('gst_type');

        $commaValues = explode(",", $files);
        $userDetails = User::find($userId);
        $useName = $userId;
        $zipName = $gst_type . '-' . $useName . '.zip';
        $folderPath = 'public/uploads/users/' . $useName . '/Gst/' . $gst_type . '/';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = $folderPath . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('/admin/user/gsttype/details/' . $gstId)->with('filenotexistsection1', 'File Not Exist!');
                }
            }
        } else {
            if (!empty($files)) {
                $filePath = $folderPath . $files;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($files), $fileContents);
                } else {
                    return redirect('/admin/user/gsttype/details/' . $gstId)->with('filenotexistsection1', 'File Not Exist!');
                }
            } else {
                return redirect('/admin/user/gsttype/details/' . $gstId)->with('filenotexistsection1', 'File Not Exist!');
            }

        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }

    public function statusview($item_id)
    {
        if ($item_id) {
            $singleGst = UserGstDetail::find($item_id);
            return $singleGst;
            //return view('admin.pages.users.modal')->with($data);
        }
    }

    public function ajax()
    {
        $items = UserGstDetail::select(
            'name',
            'image',
            'status',
            'gst_number',
            'admin_note',
            'user_note',
            'email',
            'id'
        )->orderBy('id', 'DESC');

        return DataTables::of($items)->make(true);
    }

    public function show($item_id)
    {
        $item = UserGstDetail::find($item_id);
        if (empty($item)) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.pages.users.show', [
            'item' => $item,
        ]);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('item_id');
        $item = UserGstDetail::find($item_id);

        if (empty($item)) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found!',
            ], 404);
        } else {
            $item->delete();

            return response()->json([
                'success' => true,
                'message' => 'Item successfully deleted.',
            ], 200);
        }
    }

    public function change_status(Request $request)
    {
        $userId = $request->userid;
        $userDetails = User::find($userId);
        $useName = $userId;
        $gstid = $request->gstid;
        if ($request->type == 'approve') {

            $validatedData = $request->validate([
                'gst_number' => 'required',
            ]);

            $folderName = 'public/uploads/users/' . $useName . '/Gst/ApprovedImg';
            $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');

            $datas = UserGstDetail::find($gstid);
            $datas->last_update_by = 'admin';
            $datas->status = 4; // Approved
            $datas->trade_name = ($request->trade_name) ?? $request->trade_name;
            $datas->gst_number = $request->gst_number;
            $datas->approved_img = $img['approved_img'];
            $datas->save();
        } else {

            $folderName = 'public/uploads/users/' . $useName . '/Gst/RaisedImg';
            $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');

            $datas = UserGstDetail::find($gstid);
            $datas->admin_note = $request->admin_note;
            $datas->last_update_by = 'admin';
            $datas->raised_img = $img['raised_img'];
            $datas->status = 2;
            $datas->save();
        }
        return redirect('admin/user/gst/details/' . $userId)->with('success', 'Uploaded the Document!');
    }

    public function additionalFile(Request $request, $userId)
    {
        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $userDetails = User::find($userId);

        $useName = $userId;
        $zipName = "QueryUpdatedFile-" . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '/Gst/AdditionalImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('admin/user/gst/details/' . $userId)->with('additionalfilenotexist_gst', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/Gst/AdditionalImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('admin/user/gst/details/' . $userId)->with('additionalfilenotexist_gst', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }

    public function approvedFile(Request $request, $userId)
    {

        $files = $request->input('files');
        $commaValues = explode(",", $files);
        $userDetails = User::find($userId);

        $useName = $userId;
        $zipName = "GstApprovedFile-" . $useName . '.zip';
        $zip = new \ZipArchive();
        $zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        if (count($commaValues) > 1) {
            foreach ($commaValues as $file) {
                $filePath = 'public/uploads/users/' . $useName . '/Gst/ApprovedImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('admin/user/gst/details/' . $userId)->with('approvedfilenotexist_gst', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/Gst/ApprovedImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('admin/user/gst/details/' . $userId)->with('approvedfilenotexist_gst', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }
}
