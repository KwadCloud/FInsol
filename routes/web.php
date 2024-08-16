<?php
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\SitemapController;

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/', function () {
    return view('welcome');
})->name('front');

Route::group(
    [
        'namespace' => 'Auth',
    ],
    function () {
        // Authentication Routes...
        Route::get('login', 'LoginController@showLoginForm')->name('login_page');
        //Route::post('login', 'LoginController@checkOTP')->name('login');
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::get('logout', 'LoginController@logout')->name('logout_page');
        Route::post('send-otp', 'LoginController@generateOTPForm')->name('otp.send');
        Route::get('resend-otp/{id}', 'LoginController@resendOTP')->name('otp.resend');

        // Registration Routes...
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register_page');
        Route::post('register', 'RegisterController@register')->name('register');
        Route::get('register/activate/{token}', 'RegisterController@confirm')->name('email_confirm');
        Route::post('check-unique-email', 'RegisterController@checkUniqueEmail');

        // Password Reset Routes...
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset');

        //Email Verification Routes
        Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
        Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
    },
);

Route::get('home', 'UserController@index')->name('home');
Route::get('settings', 'UserController@settings')->name('settings');
Route::get('settings/update', 'UserController@settingsUpdate')->name('settings.update');

// Terms and Privacy

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/tos', function () {
    return view('tos');
})->name('tos');

Route::get('/refund', function () {
    return view('refund');
})->name('refund');

// GST DETAILS
Route::get('gst', 'GstController@index')->name('gst');
Route::get('gst/register', 'GstController@register_form')->name('gst.register_form');

Route::get('gst/existing_register', 'GstController@existing_register_form')->name('gst.existing_register_form');
Route::post('gst/existing', 'GstController@storeExistingRegister')->name('gst.existing');

Route::post('gst/individual', 'GstController@storeIndividual')->name('gst.individual');
Route::post('gst/firm', 'GstController@storeFirm')->name('gst.firm');
Route::post('gst/company', 'GstController@storeCompany')->name('gst.company');
Route::get('gst/business', 'GstController@businessStatus')->name('gst.business_status');
Route::get('gst/copyofreturns', 'GstController@copyOfReturns')->name('gst.copy_of_returns');
Route::post('gst/copyofreturns', 'GstController@copyOfReturns')->name('gst.copy_of_returns.filter');
Route::post('gst/queryraised', 'GstController@queryRaised')->name('gst.query_raised');
Route::get('gst/uploaddocuments', 'GstController@uploadDocuments')->name('gst.uploaddocuments');
Route::post('userSettings', 'GstController@userSettings')->name('userSettings');

Route::post('gst/gettradename', 'GstController@getTradeName')->name('gst.gettradename');
Route::post('gst/uploaddocumentscreate', 'GstController@uploadDocumentsCreate')->name('gst.uploaddocumentscreate');

Route::post('gst/download/approved/file', 'GstController@approvedFile')->name('approvedFile');
Route::post('gst/download/uploaddocument/file', 'GstController@uploadDocumentFile')->name('uploadDocumentFile');
Route::post('gst/download/raised/file', 'GstController@raisedFile')->name('raisedFile');

Route::post('gst/getformtype', 'GstController@getFormType')->name('gst.getformtype');
Route::post('gst/getyear', 'GstController@getYear')->name('gst.getyear');
Route::post('gst/getmonth', 'GstController@getMonth')->name('gst.getmonth');
Route::post('gst/getquarter', 'GstController@getQuarter')->name('gst.getquarter');
Route::post('gst/download/copyofreturns/file', 'GstController@copyofreturnsFile')->name('copyofreturnsFile');

// Registration Dashboard details for all forms
Route::get('dashboard', 'DashboardController@index')->name('form_dashboard');
Route::post('form/download/raised/file', 'DashboardController@raisedFile')->name('form_web_raisedFile');
Route::post('form/download/approved/file', 'DashboardController@approvedFile')->name('form_web_approvedFile');
Route::post('form/queryraised', 'DashboardController@queryRaised')->name('form.query_raised');

//PAN DETAILS
Route::get('pan/register', 'PanController@register_form')->name('pan.register_form');
Route::post('pan/register', 'PanController@storePan')->name('pan.register');
Route::post('dashboard_register', 'DashboardController@createInstaMojoOrder')->name('dashboard.register');
Route::get('store_payment_data', 'DashboardController@storePaymentData')->name('dashboard.storedata');

//
Route::get('pay/register', 'PayController@register_form')->name('pay.register_form');
Route::post('pay/register', 'PayController@storePay')->name('pay.register');

//TAN DETAILS
Route::get('tan/register', 'TanController@register_form')->name('tan.register_form');
Route::post('tan/register', 'TanController@storeTan')->name('tan.register');

//Epf DETAILS
Route::get('epf/register', 'EpfController@register_form')->name('epf.register_form');
Route::post('epf/company', 'EpfController@storeEpfCompany')->name('epf.register.company');
Route::post('epf/others', 'EpfController@storeEpfOthers')->name('epf.register.others');

//ESIC DETAILS
Route::get('esic/register', 'ESICController@register_form')->name('esic.register_form');
Route::post('esic/company', 'ESICController@storeEsicCompany')->name('esic.register.company');
Route::post('esic/others', 'ESICController@storeEsicOthers')->name('esic.register.others');

//TradeMark DETAILS
Route::get('trademark/register', 'TradeMarkController@register_form')->name('trademark.register_form');
Route::post('trademark/company', 'TradeMarkController@storeTrademarkCompany')->name('trademark.register.company');
Route::post('trademark/others', 'TradeMarkController@storeTrademarkOthers')->name('trademark.register.others');

//Company Regitration DETAILS
Route::get('company/register', 'CompanyController@register_form')->name('company.register_form');
Route::post('company', 'CompanyController@storeCompany')->name('company.register');
Route::post('company/register', 'CompanyController@register_form')->name('company.pamentregister');

//Partnership Regitration DETAILS
Route::get('partnership/register', 'PartnershipController@register_form')->name('partnership.register_form');
Route::post('partnership', 'PartnershipController@storePartnership')->name('partnership.register');
Route::post('partnership/register', 'PartnershipController@register_form')->name('partnership.paymentregister');

//HUF Regitration DETAILS
Route::get('huf/register', 'HufController@register_form')->name('huf.register_form');
Route::post('huf', 'HufController@storeHuf')->name('huf.register');
Route::post('huf/register', 'HufController@register_form')->name('huf.paymentregister');

//Trust Regitration DETAILS
Route::get('trust/register', 'TrustController@register_form')->name('trust.register_form');
Route::post('trust', 'TrustController@storeTrust')->name('trust.register');
Route::post('trust/register', 'TrustController@register_form')->name('trust.paymentregister');

//Udamy Registration DETAILS
Route::get('udamy/register', 'UdamyController@register_form')->name('udamy.register_form');
Route::post('udamy/register', 'UdamyController@storeUdamy')->name('udamy.register');

//Import Export Code registration DETAILS
Route::get('importexport/register', 'ImportExportController@register_form')->name('importexport.register_form');
Route::post('importexport/register', 'ImportExportController@storeImportExport')->name('importexport.register');
//  Route::post('importexport/register', 'ImportExportController@register_form')->name('importexport.paymentregister');

//Labour License registration DETAILS
Route::get('labour/register', 'LabourController@register_form')->name('labour.register_form');
Route::post('labour/petty', 'LabourController@storePetty')->name('labour.register.petty');
Route::post('labour/labour', 'LabourController@storeLabour')->name('labour.register.labour');

//SHOP DETAILS
Route::get('shop/register', 'ShopController@register_form')->name('shop.register_form');
Route::post('shop/register', 'ShopController@storeShop')->name('shop.register');
// Route::post('shop/register', 'ShopController@register_form')->name('shop.pamentregister');

//ISO DETAILS
Route::get('iso/register', 'IsoController@register_form')->name('iso.register_form');
Route::post('iso/register', 'IsoController@storeIso')->name('iso.register');

//Fssai DETAILS
Route::get('fssai/register', 'FssaiController@register_form')->name('fssai.register_form');
Route::post('fssai/register', 'FssaiController@storeFssai')->name('fssai.register');

//IT Act
Route::get('it-act/dashboard', 'ITActController@index')->name('it_act.dashboard');

//Itr DETAILS
Route::get('itr/register', 'ItrController@register_form')->name('itr.register_form');
Route::post('itr/register', 'ItrController@storeItr')->name('itr.register');

//Taxaudit DETAILS
Route::get('taxaudit/register', 'TaxauditController@register_form')->name('taxaudit.register_form');
Route::post('taxaudit/register', 'TaxauditController@storeTaxaudit')->name('taxaudit.register');

//Tds DETAILS
Route::get('tds/register', 'TdsController@register_form')->name('tds.register_form');
Route::post('tds/register', 'TdsController@storeTds')->name('tds.register');

//Factory License Code registration DETAILS
Route::get('factorylicense/register', 'FactoryLicenseController@register_form')->name('factorylicense.register_form');
Route::post('factorylicense/register', 'FactoryLicenseController@storeFactoryLicense')->name('factorylicense.register');

//ISI Details
Route::get('isi/register', 'ISIController@register_form')->name('isi.register_form');
Route::post('isi/register', 'ISIController@storeISI')->name('isi.register');

//IT ACT Payment Routes
Route::post('it-act/payment-register', 'ITActController@createInstaMojoOrder')->name('itAct.register');
Route::get('it-act/store_payment_data', 'ITActController@storePaymentData')->name('itAct.storedata');

Route::group(
    [
        'namespace' => 'CompaniesAct',
    ],
    function () {
        // CompaniesAct
        Route::get('minutes/register', 'MinutesController@register_form')->name('minutes.register_form');
        Route::post('minutes/register', 'MinutesController@storeMinutes')->name('minutes.register');

        Route::get('mgt/register', 'MgtController@register_form')->name('mgt.register_form');
        Route::post('mgt/register', 'MgtController@storeMgt')->name('mgt.register');

        Route::get('adt/register', 'AdtController@register_form')->name('adt.register_form');
        Route::post('adt/register', 'AdtController@storeAdt')->name('adt.register');

        Route::get('aoc/register', 'AocController@register_form')->name('aoc.register_form');
        Route::post('aoc/register', 'AocController@storeAoc')->name('aoc.register');

        Route::get('dinkyc/register', 'DinkycController@register_form')->name('dinkyc.register_form');
        Route::post('dinkyc/register', 'DinkycController@storeDinkyc')->name('dinkyc.register');

        Route::get('statutoryaudit/register', 'StatutoryAuditController@register_form')->name('statutoryaudit.register_form');
        Route::post('statutoryaudit/register', 'StatutoryAuditController@storeAudit')->name('statutoryaudit.register');

        // Companies Act Dashboard details for all forms
        Route::get('companiesact/dashboard', 'DashboardController@index')->name('companiesact_dashboard');
        Route::post('companiesact/download/raised/file', 'DashboardController@raisedFile')->name('companiesact_web_raisedFile');
        Route::post('companiesact/download/approved/file', 'DashboardController@approvedFile')->name('companiesact_web_approvedFile');
        Route::post('companiesact/queryraised', 'DashboardController@queryRaised')->name('companiesact_query_raised');
        
        //Companies Act Payment Routes
        Route::post('companiesact/payment-register', 'DashboardController@createInstaMojoOrder')->name('companiesact.register');
        Route::get('companiesact/store_payment_data', 'DashboardController@storePaymentData')->name('companiesact.storedata');
    },
);

Route::group(
    [
        'namespace' => 'Certification',
    ],
    function () {
        // All about certification
        Route::get('ca/register', 'CaController@register_form')->name('ca.register_form');
        Route::post('ca/register', 'CaController@storeCa')->name('ca.register');

        Route::get('networth/register', 'NetworthController@register_form')->name('networth.register_form');
        Route::post('networth/register', 'NetworthController@storeNetworth')->name('networth.register');

        Route::get('turnover/register', 'TurnoverController@register_form')->name('turnover.register_form');
        Route::post('turnover/register', 'TurnoverController@storeTurnover')->name('turnover.register');

        // certification Dashboard
        Route::get('certification/dashboard', 'DashboardController@index')->name('certification_dashboard');
        Route::post('certification/download/raised/file', 'DashboardController@raisedFile')->name('certification_web_raisedFile');
        Route::post('certification/download/approved/file', 'DashboardController@approvedFile')->name('certification_web_approvedFile');
        Route::post('certification/queryraised', 'DashboardController@queryRaised')->name('certification_query_raised');
        
        //Certification Payment Routes
        Route::post('certification/payment-register', 'DashboardController@createInstaMojoOrder')->name('certification.register');
        Route::get('certification/store_payment_data', 'DashboardController@storePaymentData')->name('certification.storedata');
    },
);

//Loan & Finance
Route::group(
    ['namespace' => 'LoanFinance'], function () {
        Route::get('loan-finance/estimated/register', 'EstimatedController@register_form')->name('estimated.register_form');
        Route::post('loan-finance/estimated/register', 'EstimatedController@storeEstimated')->name('estimated.register');

        Route::get('loan-finance/cma/register', 'CMAController@register_form')->name('cma.register_form');
        Route::post('loan-finance/cma/register', 'CMAController@storeCMA')->name('cma.register');

        Route::get('loan-finance/project-report/register', 'ProjectReportController@register_form')->name('projectReport.register_form');
        Route::post('loan-finance/project-report/register', 'ProjectReportController@storeProjectReport')->name('projectReport.register');

        //Loan & Finance Dashboard
        Route::get('loan-finance/dashboard', 'DashboardController@index')->name('loan_dashboard');
        Route::post('loan-finance/download/raised/file', 'DashboardController@raisedFile')->name('loan_web_raisedFile');
        Route::post('loan-finance/download/approved/file', 'DashboardController@approvedFile')->name('loan_web_approvedFile');
        Route::post('loan-finance/queryraised', 'DashboardController@queryRaised')->name('loan_query_raised');
        
        //Loan & Finance Payment Routes
        Route::post('loan-finance/payment-register', 'DashboardController@createInstaMojoOrder')->name('loan.register');
        Route::get('loan-finance/store_payment_data', 'DashboardController@storePaymentData')->name('loan.storedata');
    }
);

//Legal Work
Route::group(
    ['namespace' => 'LegalWork'], function () {
        Route::get('legal-work/register', 'LegalController@register_form')->name('legalwork.register_form');
        Route::post('legal-work/register', 'LegalController@storeLegalWork')->name('legalwork.register');

        //LegalWork Dashboard
        Route::get('legal-work/dashboard', 'DashboardController@index')->name('legalwork.dashboard');
        Route::post('legal-work/download/raised/file', 'DashboardController@raisedFile')->name('legalwork_web_raisedFile');
        Route::post('legal-work/download/approved/file', 'DashboardController@approvedFile')->name('legalwork_web_approvedFile');
        Route::post('legal-work/queryraised', 'DashboardController@queryRaised')->name('legalwork_query_raised');
        
        //LegalWork Payment Routes
        Route::post('legal-work/payment-register', 'DashboardController@createInstaMojoOrder')->name('legalwork.payment_register');
        Route::get('legal-work/store_payment_data', 'DashboardController@storePaymentData')->name('legalwork.storedata');
    }
);

Route::get('register/get-districts/{stateId}', [DropdownController::class, 'getDistricts']);
Route::get('register/get-blocks/{districtId}', [DropdownController::class, 'getBlocks']);
Route::get('payments', 'PaymentsController@index')->name('form_payment');

Route::get('profile', 'UserController@profile')->name('user_profile');
Route::get('profile/edit', 'UserController@profileEdit')->name('user_profile_edit');
Route::get('change-password', 'UserController@editPassword')->name('user_password_change_form');
Route::post('password-update', 'UserController@updatePassword')->name('user_password_update');
Route::put('profile-info-update', 'UserController@save_profile')->name('user_save_profile');
Route::post('update_image', 'UserController@update_image')->name('user_image_update');
