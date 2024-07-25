<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper as Helper;
use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\User;
use App\Models\UserCompanyDetail;
use App\Models\UserCompanySignatory;
use App\Models\UserEpfDetail;
use App\Models\UserEpfSignatory;
use App\Models\UserEsicDetail;
use App\Models\UserEsicSignatory;
use App\Models\UserFactoryLicenseDetail;
use App\Models\UserFssaiDetail;
use App\Models\UserGstDetail;
use App\Models\UserHufDetail;
use App\Models\UserHufMember;
use App\Models\UserImportExportDetail;
use App\Models\UserIsoDetail;
use App\Models\UserItrDetail;
use App\Models\UserLabourDetail;
use App\Models\UserLabourSignatory;
use App\Models\UserPanDetail;
use App\Models\UserPartnershipDetail;
use App\Models\UserPartnershipPartner;
use App\Models\UserShopDetail;
use App\Models\UserTanDetail;
use App\Models\UserTaxauditDetail;
use App\Models\UserTdsDetail;
use App\Models\UserTrademarkDetail;
use App\Models\UserTrademarkSignatory;
use App\Models\UserTrustDetail;
use App\Models\UserTrustMember;
use App\Models\UserUdamyDetail;
use App\Models\UserISIDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class FormsDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request, $userId)
    {
        $data['user'] = User::where('id', $userId)->first();
        $data['routeurl'] = Helper::getBaseUrl($request);
        $data['usersGst'] = UserGstDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersPan'] = UserPanDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersTan'] = UserTanDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersEpf'] = UserEpfDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersEsic'] = UserEsicDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersTrademark'] = UserTrademarkDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersCompany'] = UserCompanyDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersPartnership'] = UserPartnershipDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersHuf'] = UserHufDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersTrust'] = UserTrustDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersUdamy'] = UserUdamyDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersImportExport'] = UserImportExportDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersLabour'] = UserLabourDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersShop'] = UserShopDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersIso'] = UserIsoDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersIsi'] = UserISIDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersFssai'] = UserFssaiDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersItr'] = UserItrDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersTaxaudit'] = UserTaxauditDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersTds'] = UserTdsDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        $data['usersFactoryLicense'] = UserFactoryLicenseDetail::select('*')->where('user_id', $userId)->orderBy('id', 'DESC')->get();
        return view('admin.pages.users.forms.forms_dashboard')->with($data);
    }

    public function profile($userId)
    {
        $data['userId'] = $userId;
        return view('admin.pages.users.profile')->with($data);
    }

    public function allProfile($name, $Id)
    {
        if ($name == 'pan') {
            $data['panDetails'] = UserPanDetail::find($Id);
            $data['panDocuments'] = Documents::where(['for_multiple' => 'PAN'])->get();
        }

        if ($name == 'tan') {
            $data['tanDetails'] = UserTanDetail::find($Id);
            $data['tanDocuments'] = Documents::where(['for_multiple' => 'TAN'])->get();
        }

        if ($name == 'epf') {
            $data['epfDetails'] = UserEpfDetail::find($Id);
            $data['epfDocuments'] = Documents::where(['for_multiple' => 'EPF Company'])->get();
            $data['epfOtherDocuments'] = Documents::where(['for_multiple' => 'EPF Others'])->get();
            $data['epfSignatory'] = UserEpfSignatory::where(['user_epf_id' => $Id])->get();
            $data['epfSignatoryDocuments'] = Documents::where(['for_multiple' => 'EPF Signatory'])->get();
        }

        if ($name == 'esic') {
            $data['esicDetails'] = UserEsicDetail::find($Id);
            $data['esicDocuments'] = Documents::where(['for_multiple' => 'ESIC Company'])->get();
            $data['esicSignatory'] = UserEsicSignatory::where(['user_esic_id' => $Id])->get();
            $data['esicSignatoryDocuments'] = Documents::where(['for_multiple' => 'ESIC Signatory'])->get();
            $data['esicOthers'] = UserEsicSignatory::where(['user_esic_id' => $Id])->get();
            $data['esicOthersDocuments'] = Documents::where(['for_multiple' => 'ESIC Others'])->get();
        }

        if ($name == 'trademark') {
            $data['trademarkDetails'] = UserTrademarkDetail::find($Id);
            $data['trademarkDocuments'] = Documents::where(['for_multiple' => 'TRADEMARK Company'])->get();
            $data['trademarkSignatory'] = UserTrademarkSignatory::where(['user_trademark_id' => $Id])->get();
            $data['trademarkSignatoryDocuments'] = Documents::where(['for_multiple' => 'TRADEMARK Signatory'])->get();
            $data['trademarkOthers'] = UserTrademarkSignatory::where(['user_trademark_id' => $Id])->get();
            $data['trademarkOthersDocuments'] = Documents::where(['for_multiple' => 'TRADEMARK Others'])->get();
        }

        if ($name == 'company') {
            $data['companyDetails'] = UserCompanyDetail::find($Id);
            $data['companyDocuments'] = Documents::where(['for_multiple' => 'COMPANY'])->get();
            $data['companyDirector'] = UserCompanySignatory::where(['user_comp_id' => $Id])->get();
            $data['companyDirectorDocuments'] = Documents::where(['for_multiple' => 'COMPANY Signatory'])->get();
        }

        if ($name == 'partnership') {
            $data['partnershipDetails'] = UserPartnershipDetail::find($Id);
            $data['partnershipDocuments'] = Documents::where(['for_multiple' => 'PARTNERSHIP'])->get();
            $data['partnershipPartner'] = UserPartnershipPartner::where(['user_partnership_id' => $Id])->get();
            $data['partnershipPartnerDocuments'] = Documents::where(['for_multiple' => 'PARTNERSHIP Partner'])->get();
        }

        if ($name == 'huf') {
            $data['hufDetails'] = UserHufDetail::find($Id);
            $data['hufMember'] = UserHufMember::where(['user_huf_id' => $Id])->get();
            $data['hufMemberDocuments'] = Documents::where(['for_multiple' => 'HUF Member'])->get();
        }

        if ($name == 'trust') {
            $data['trustDetails'] = UserTrustDetail::find($Id);
            $data['trustDocuments'] = Documents::where(['for_multiple' => 'TRUST'])->get();
            $data['trustMember'] = UserTrustMember::where(['user_trust_id' => $Id])->get();
            $data['trustMemberDocuments'] = Documents::where(['for_multiple' => 'TRUST Member'])->get();
        }

        if ($name == 'udamy') {
            $data['udamyDetails'] = UserUdamyDetail::find($Id);
            $data['udamyDocuments'] = Documents::where(['for_multiple' => 'UDAMY'])->get();
        }

        if ($name == 'importexport') {
            $data['importexportDetails'] = UserImportExportDetail::find($Id);
            $data['importexportDocuments'] = Documents::where(['for_multiple' => 'IE'])->get();
        }

        if ($name == 'labour') {
            $data['labourDetails'] = UserLabourDetail::find($Id);
            $data['labourDocuments'] = Documents::where(['for_multiple' => 'Petty Contract'])->get();
            $data['labourSignatory'] = UserLabourSignatory::where(['user_labour_id' => $Id])->get();
            $data['labourSignatoryDocuments'] = Documents::where(['for_multiple' => 'Petty Contract Signatory'])->get();
            $data['labourOthersDocuments'] = Documents::where(['for_multiple' => 'Labour Contract'])->get();
        }

        if ($name == 'shop') {
            $data['shopDetails'] = UserShopDetail::find($Id);
            $data['shopDocuments'] = Documents::where(['for_multiple' => 'SHOP'])->get();
        }

        if ($name == 'iso') {
            $data['isoDetails'] = UserIsoDetail::find($Id);
            $data['isoDocuments'] = Documents::where(['for_multiple' => 'ISO'])->get();
        }

        if ($name == 'isi') {
            $data['isiDetails'] = UserISIDetail::find($Id);
            $data['isiDocuments'] = Documents::where(['for_multiple' => 'ISI'])->get();
        }

        if ($name == 'fssai') {
            $data['fssaiDetails'] = UserFssaiDetail::find($Id);
            $data['fssaiDocuments'] = Documents::where(['for_multiple' => 'FSSAI'])->get();
        }

        if ($name == 'itr') {
            $data['itrDetails'] = UserItrDetail::find($Id);
            $data['itrDocuments'] = Documents::where(['for_multiple' => 'ITR'])->get();
        }

        if ($name == 'taxaudit') {
            $data['taxauditDetails'] = UserTaxauditDetail::find($Id);
            $data['taxauditDocuments'] = Documents::where(['for_multiple' => 'TAXAUDIT'])->get();
        }

        if ($name == 'tds') {
            $data['tdsDetails'] = UserTdsDetail::find($Id);
            $data['tdsDocuments'] = Documents::where(['for_multiple' => 'TDS'])->get();
        }

        if ($name == 'factorylicense') {
            $data['factorylicenseDetails'] = UserFactoryLicenseDetail::find($Id);
            $data['factorylicenseDocuments'] = Documents::where(['for_multiple' => 'FL'])->get();
        }
        $page['profilePage'] = $name;

        return view('admin.pages.users.forms.all_profiles')->with($data)->with($page);
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
                    return redirect('/admin/user/forms/details/' . $id)->with('filenotexist', 'File Not Exist!');
                }
            }
        } else {
            if (!empty($files)) {
                $filePath = $folderPath . $files;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($files), $fileContents);
                } else {
                    return redirect('/admin/user/forms/details/' . $id)->with('filenotexist', 'File Not Exist!');
                }
            } else {
                return redirect('/admin/user/forms/details/' . $id)->with('filenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
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
                if ($formtype == "tan") {

                    $details = UserTanDetail::find($id);
                    $content = '<label>Tan Number</label>
                <input type="text" class="form-control" name="tan_number"  required="required" value=""  placeholder="Enter the Tan Number" />
                <label>Name of Tan</label>
                <input type="text"  required="required" class="form-control" id="nameoftan" name="name_of_tan" value="' . $details->name_of_tan . '"  placeholder="Name of Tan" />';

                } else if ($formtype == "pan") {

                    $details = UserPanDetail::find($id);
                    $content = '<label>Pan Number</label>
                <input type="text" class="form-control"  required="required" name="pan_number" value=""  placeholder="Enter the Pan Number" />
                <label>Name of Pan</label>
                <input type="text"  required="required" class="form-control"  name="name_of_pan" value="' . $details->name_of_pan . '" placeholder="Name of Pan" />';

                } else if ($formtype == "epf") {

                    $details = UserEpfDetail::find($id);
                    $content = '<label>Epf Number</label>
                    <input type="text" class="form-control"  required="required" name="epf_number" value="" placeholder="Enter the Epf Number" />
                    <label>Name of Epf</label>
                    <input type="text"  required="required" class="form-control"  name="name_of_epf" value="' . $details->name_of_epf . '" placeholder="Name of Epf" />';

                } else if ($formtype == "esic") {

                    $details = UserEsicDetail::find($id);
                    $content = '<label>ESIC Number</label>
                        <input type="text" class="form-control"  required="required" name="esic_number" value="" placeholder="Enter the Esic Number" />
                        <label>Name of Esic</label>
                        <input type="text"  required="required" class="form-control"  name="name_of_esic" value="' . $details->name_of_esic . '" placeholder="Name of Esic" />';

                } else if ($formtype == "trademark") {

                    $details = UserTrademarkDetail::find($id);
                    $content = '<label>Trademark Number</label>
                            <input type="text" class="form-control"  required="required" name="trademark_number" value="" placeholder="Enter the Trademark Number" />
                            <label>Name of Trademark</label>
                            <input type="text"  required="required" class="form-control"  name="name_of_trademark" value="' . $details->name_of_trademark . '" placeholder="Name of Trademark" />';

                } else if ($formtype == "company") {

                    $details = UserCompanyDetail::find($id);
                    $content = '<label>Company Number</label>
                                <input type="text" class="form-control"  required="required" name="company_number" value="" placeholder="Enter the Company Number" />
                                <label>Name of Company</label>
                                <input type="text"  required="required" class="form-control"  name="name_of_company" value="' . $details->name_of_company . '" placeholder="Name of Company" />';

                } else if ($formtype == "partnership") {

                    $details = UserPartnershipDetail::find($id);
                    $content = '<label>Partnership Number</label>
                                    <input type="text" class="form-control"  required="required" name="partnership_number" value="" placeholder="Enter the Partnership Number" />
                                    <label>Name of Partnership</label>
                                    <input type="text"  required="required" class="form-control"  name="name_of_partnership" value="' . $details->name_of_partnership . '" placeholder="Name of Partnership" />';

                } else if ($formtype == "huf") {

                    $details = UserHufDetail::find($id);
                    $content = '<label>Huf Number</label>
                                        <input type="text" class="form-control"  required="required" name="huf_number" value="" placeholder="Enter the Huf Number" />
                                        <label>Name of Huf</label>
                                        <input type="text"  required="required" class="form-control"  name="name_of_huf" value="' . $details->name_of_huf . '" placeholder="Name of Huf" />';

                } else if ($formtype == "trust") {

                    $details = UserTrustDetail::find($id);
                    $content = '<label>Trust Number</label>
                                            <input type="text" class="form-control"  required="required" name="trust_number" value="" placeholder="Enter the Trust Number" />
                                            <label>Name of Trust</label>
                                            <input type="text"  required="required" class="form-control"  name="name_of_trust" value="' . $details->name_of_trust . '" placeholder="Name of Trust" />';

                } else if ($formtype == "udamy") {
                    $details = UserUdamyDetail::find($id);
                    $content = '<label>Udamy Number</label>
                                                <input type="text" class="form-control"  required="required" name="udamy_number" value="" placeholder="Enter the Udamy Number" />
                                                <label>Name of Udamy</label>
                                                <input type="text"  required="required" class="form-control"  name="name_of_udamy" value="' . $details->name_of_udamy . '" placeholder="Name of Udamy" />';
                } else if ($formtype == "importexport") {
                    $details = UserImportExportDetail::find($id);
                    $content = '<label>Firm Number</label>
                                                <input type="text" class="form-control"  required="required" name="firm_number" value="" placeholder="Enter the Firm Number" />
                                                <label>Name of Firm</label>
                                                <input type="text"  required="required" class="form-control"  name="name_of_firm" value="' . $details->name_of_firm . '" placeholder="Name of Firm" />';
                } else if ($formtype == "labour") {

                    $details = UserLabourDetail::find($id);
                    $content = '<label>Labour Number</label>
                                                    <input type="text" class="form-control"  required="required" name="labour_number" value="" placeholder="Enter the Labour Number" />
                                                    <label>Name of Labour</label>
                                                    <input type="text"  required="required" class="form-control"  name="name_of_labour" value="' . $details->name_of_labour . '" placeholder="Name of Labour" />';

                } else if ($formtype == "shop") {

                    $details = UserShopDetail::find($id);
                    $content = '<label>Shop Number</label>
                                                        <input type="text" class="form-control"  required="required" name="shop_number" value="" placeholder="Enter the Shop Number" />
                                                        <label>Name of Shop</label>
                                                        <input type="text"  required="required" class="form-control" id="nameofshop" name="name_of_shop" value="' . $details->name_of_shop . '"  placeholder="Name of Shop" />';

                } else if ($formtype == "iso") {

                    $details = UserIsoDetail::find($id);
                    $content = '<label>ISO Number</label>
                                                        <input type="text" class="form-control"  required="required" name="iso_number"   placeholder="Enter the Iso Number" />
                                                        <label>Name of ISO</label>
                                                        <input type="text"  required="required" class="form-control" id="nameofiso" name="name_of_iso" value="' . $details->name_of_iso . '"  placeholder="Name of Iso" />';
                } else if ($formtype == "isi") {

                    $details = UserISIDetail::find($id);
                    $content = '<label>ISI Number</label>
                    <input type="text" class="form-control"  required="required" name="isi_number"   placeholder="Enter the ISI Number" />
                    <label>Name of ISI</label>
                    <input type="text"  required="required" class="form-control" id="nameofiso" name="name_of_company" value="' . $details->name_of_company . '"  placeholder="Name of ISI" />';
                } else if ($formtype == "fssai") {

                    $details = UserFssaiDetail::find($id);
                    $content = '<label>Fssai Number</label>
                                                        <input type="text" class="form-control"  required="required" name="fssai_number"   placeholder="Enter the Fssai Number" />
                                                        <label>Name of Fssai</label>
                                                        <input type="text"  required="required" class="form-control" id="nameoffssai" name="name_of_fssai" value="' . $details->name_of_fssai . '"  placeholder="Name of Fssai" />';
                } else if ($formtype == "itr") {

                    $details = UserItrDetail::find($id);
                    $content = '<label>Itr Number</label>
                                                        <input type="text" class="form-control"  required="required" name="itr_number"   placeholder="Enter the Itr Number" />
                                                        <label>Name of Itr</label>
                                                        <input type="text"  required="required" class="form-control" id="nameofitr" name="name_of_itr" value="' . $details->name_of_itr . '"  placeholder="Name of Itr" />';
                } else if ($formtype == "taxaudit") {

                    $details = UserTaxauditDetail::find($id);
                    $content = '<label>Tax Audit Number</label>
                                                        <input type="text" class="form-control"  required="required" name="taxaudit_number"   placeholder="Enter the Taxaudit Number" />
                                                        <label>Name of Tax</label>
                                                        <input type="text"  required="required" class="form-control" id="nameoftaxaudit" name="name_of_taxaudit" value="' . $details->name_of_taxaudit . '"  placeholder="Name of Taxaudit" />';
                } else if ($formtype == "tds") {

                    $details = UserTdsDetail::find($id);
                    $content = '<label>Tds/Tcs  Number</label>
                                                        <input type="text" class="form-control"  required="required" name="tds_number"   placeholder="Enter the Tds/Tcs  Number" />
                                                        <label>Name of Tds/Tcs </label>
                                                        <input type="text"  required="required" class="form-control" id="nameoftds" name="name_of_tds" value="' . $details->name_of_itr . '"  placeholder="Name of Tds/Tcs " />';
                } else if ($formtype == "factorylicense") {
                    $details = UserFactoryLicenseDetail::find($id);
                    $content = '<label>Factory License Number</label>
                                                        <input type="text" class="form-control"  required="required" name="facl_number" value="" placeholder="Enter the Factory License Number" />
                                                        <label>Name of Factory License</label>
                                                        <input type="text"  required="required" class="form-control"  name="name_of_facl" value="' . $details->name_of_facl . '" placeholder="Name of Factory License" />';
                }

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

    // Delete Row
    public function delete(Request $request)
    {
        $item_id = $request->get('item_id');
        $item = UserPanDetail::find($item_id);

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

    // change note to quary raised, and query updated to approve
    public function change_status(Request $request)
    {
        $userId = $request->userid;
        $userDetails = User::find($userId);
        $useName = $userId;
        $route = $request->routeis;

        switch ($route) {
            case "pan":
                $folderNameChange = ($request->type == 'approve') ? '/Pan/ApprovedImg' : '/Pan/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $panid = $request->id;
                $datas = UserPanDetail::find($panid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_pan = $request->name_of_pan;
                    $datas->pan_number = $request->pan_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;
            case "tan":
                $folderNameChange = ($request->type == 'approve') ? '/Tan/ApprovedImg' : '/Tan/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $tanid = $request->id;
                $datas = UserTanDetail::find($tanid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_tan = $request->name_of_tan;
                    $datas->tan_number = $request->tan_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "epf":
                $folderNameChange = ($request->type == 'approve') ? '/Epf/ApprovedImg' : '/Epf/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $epfid = $request->id;
                $datas = UserEpfDetail::find($epfid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_epf = $request->name_of_epf;
                    $datas->epf_number = $request->epf_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "esic":
                $folderNameChange = ($request->type == 'approve') ? '/Esic/ApprovedImg' : '/Esic/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $esicid = $request->id;
                $datas = UserEsicDetail::find($esicid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_esic = $request->name_of_esic;
                    $datas->esic_number = $request->esic_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "trademark":
                $folderNameChange = ($request->type == 'approve') ? '/Trademark/ApprovedImg' : '/Trademark/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $trademarkid = $request->id;
                $datas = UserTrademarkDetail::find($trademarkid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_trademark = $request->name_of_trademark;
                    $datas->trademark_number = $request->trademark_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "company":
                $folderNameChange = ($request->type == 'approve') ? '/Company/ApprovedImg' : '/Company/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $companyid = $request->id;
                $datas = UserCompanyDetail::find($companyid);
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
                break;

            case "partnership":
                $folderNameChange = ($request->type == 'approve') ? '/Partnership/ApprovedImg' : '/Partnership/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $pid = $request->id;
                $datas = UserPartnershipDetail::find($pid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_partnership = $request->name_of_partnership;
                    $datas->partnership_number = $request->partnership_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "huf":
                $folderNameChange = ($request->type == 'approve') ? '/Huf/ApprovedImg' : '/Huf/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $hid = $request->id;
                $datas = UserHufDetail::find($hid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_huf = $request->name_of_huf;
                    $datas->huf_number = $request->huf_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "trust":
                $folderNameChange = ($request->type == 'approve') ? '/Trust/ApprovedImg' : '/Trust/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $tid = $request->id;
                $datas = UserTrustDetail::find($tid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_trust = $request->name_of_trust;
                    $datas->trust_number = $request->trust_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "udamy":
                $folderNameChange = ($request->type == 'approve') ? '/Udamy/ApprovedImg' : '/Udamy/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $uid = $request->id;
                $datas = UserUdamyDetail::find($uid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_udamy = $request->name_of_udamy;
                    $datas->udamy_number = $request->udamy_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "importexport":
                $folderNameChange = ($request->type == 'approve') ? '/ImportExport/ApprovedImg' : '/ImportExport/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $ieid = $request->id;
                $datas = UserImportExportDetail::find($ieid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_firm = $request->name_of_firm;
                    $datas->firm_number = $request->firm_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "labour":
                $folderNameChange = ($request->type == 'approve') ? '/Labour/ApprovedImg' : '/Labour/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $labourid = $request->id;
                $datas = UserLabourDetail::find($labourid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_labour = $request->name_of_labour;
                    $datas->labour_number = $request->labour_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "shop":
                $folderNameChange = ($request->type == 'approve') ? '/Shop/ApprovedImg' : '/Shop/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $shopid = $request->id;
                $datas = UserShopDetail::find($shopid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_shop = $request->name_of_shop;
                    $datas->shop_number = $request->shop_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "iso":
                $folderNameChange = ($request->type == 'approve') ? '/Iso/ApprovedImg' : '/Iso/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $isoid = $request->id;
                $datas = UserIsoDetail::find($isoid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_iso = $request->name_of_iso;
                    $datas->iso_number = $request->iso_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "isi":
                $folderNameChange = ($request->type == 'approve') ? '/ISI/ApprovedImg' : '/ISI/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $isi_id = $request->id;
                $datas = UserISIDetail::find($isi_id);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_company = $request->name_of_company;
                    $datas->isi_number = $request->isi_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "fssai":
                $folderNameChange = ($request->type == 'approve') ? '/Fssai/ApprovedImg' : '/Fssai/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $fssaiid = $request->id;
                $datas = UserFssaiDetail::find($fssaiid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_fssai = $request->name_of_fssai;
                    $datas->fssai_number = $request->fssai_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "itr":
                $folderNameChange = ($request->type == 'approve') ? '/Itr/ApprovedImg' : '/Itr/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $itrid = $request->id;
                $datas = UserItrDetail::find($itrid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_itr = $request->name_of_itr;
                    $datas->itr_number = $request->itr_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "taxaudit":
                $folderNameChange = ($request->type == 'approve') ? '/Taxaudit/ApprovedImg' : '/Taxaudit/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $taxauditid = $request->id;
                $datas = UserTaxauditDetail::find($taxauditid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_taxaudit = $request->name_of_taxaudit;
                    $datas->taxaudit_number = $request->taxaudit_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "tds":
                $folderNameChange = ($request->type == 'approve') ? '/Tds/ApprovedImg' : '/Tds/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $tdsid = $request->id;
                $datas = UserTdsDetail::find($tdsid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_tds = $request->name_of_tds;
                    $datas->tds_number = $request->tds_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            case "factorylicense":
                $folderNameChange = ($request->type == 'approve') ? '/FactoryLicense/ApprovedImg' : '/FactoryLicense/RaisedImg';
                $folderName = 'public/uploads/users/' . $useName . $folderNameChange;
                $flid = $request->id;
                $datas = UserFactoryLicenseDetail::find($flid);
                $status = ($request->type == 'approve') ? 4 : 2;
                $datas->last_update_by = 'admin';
                $datas->status = $status; // Approved
                if ($request->type == 'approve') {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'approved_img');
                    $datas->name_of_facl = $request->name_of_facl;
                    $datas->facl_number = $request->facl_number;
                    $datas->approved_img = $img['approved_img'];
                } else {
                    $img = Helper::uploadImagesNormal($request, $userId, $folderName, 'raised_img');
                    $datas->admin_note = $request->admin_note;
                    $datas->raised_img = $img['raised_img'];
                }
                $datas->save();
                break;

            default:break;
        }
        return redirect('admin/user/forms/dashboard/details/' . $userId)->with('success', 'Uploaded the Document!');
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
                $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'AdditionalImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('admin/user/forms/dashboard/details/' . $userId)->with('additionalfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'AdditionalImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('admin/user/forms/dashboard/details/' . $userId)->with('additionalfilenotexist', 'File Not Exist!');
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
                $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'ApprovedImg/' . $file;
                if (File::exists($filePath)) {
                    $fileContents = file_get_contents($filePath);
                    $zip->addFromString(basename($file), $fileContents);
                } else {
                    return redirect('admin/user/forms/dashboard/details/' . $userId)->with('approvedfilenotexist', 'File Not Exist!');
                }
            }
        } else {
            $filePath = 'public/uploads/users/' . $useName . '/' . $formType . '/' . 'ApprovedImg/' . $files;
            if (File::exists($filePath)) {
                $fileContents = file_get_contents($filePath);
                $zip->addFromString(basename($files), $fileContents);
            } else {
                return redirect('admin/user/forms/dashboard/details/' . $userId)->with('approvedfilenotexist', 'File Not Exist!');
            }
        }
        $zip->close();
        return response()->download($zipName)->deleteFileAfterSend(true);
    }
}
