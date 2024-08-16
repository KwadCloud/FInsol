<?php
use App\Http\Controllers\DropdownController;

Route::group(
    [
        'namespace' => 'Auth',
    ],
    function () {
        // Authentication Routes...
        Route::get('login', 'LoginController@showLoginForm')->name('login_page');
        Route::post('login', 'LoginController@login')->name('login');
        Route::post('logout', 'LoginController@logout')->name('logout');

        Route::get('get-districts/{stateId}', [DropdownController::class, 'getDistricts']);
        Route::get('get-blocks/{districtId}', [DropdownController::class, 'getBlocks']);
    },
);

Route::group(
    [
        'middleware' => ['auth:admin'],
    ],
    function () {
        // for all admins
        Route::get('/', 'AdminController@index')->name('dashboard');

        // for administrator
        Route::group(['middleware' => ['role:administrator']], function () {

            // users
            Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                Route::get('all', 'UserController@index')->name('index');
                Route::get('ajax', 'UserController@ajax')->name('ajax');
                Route::get('show/{id}', 'UserController@show');
                Route::post('delete', 'UserController@delete')->name('delete');
                Route::get('addform', 'UserController@addUserForm')->name('addUserForm');
                Route::post('adduser', 'UserController@addUser')->name('addUser');
            });
            Route::get('profile', 'UserController@profile');
            Route::get('employee/profile/{id}', 'UserController@profile_employee');

            Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
                Route::get('gst/details/{id}', 'UserGstController@index')->name('gstDetails');
                Route::post('gst/change_status', 'UserGstController@change_status')->name('change_status');
                Route::get('profile/{id}', 'UserGstController@profile')->name('user-profile');
                Route::get('gst/statusview/{id}', 'UserGstController@statusview')->name('gstStatusView');
                Route::get('gst/uploaddocuments/{id}', 'UserUploadDocumentsController@index')->name('useruploaddocuments');
                Route::post('gst/download/uploaddocument/file/{id}', 'UserUploadDocumentsController@adminuserUploadDocumentFile')->name('adminuserUploadDocumentFile');
                Route::post('gst/download/additional/file/{id}', 'UserGstController@additionalFile')->name('additionalFile');
                Route::post('gst/download/approved/file/{id}', 'UserGstController@approvedFile')->name('approvedFile');

                // Upload Documents make it approve
                Route::get('gst/change_approve/{id}', 'UserUploadDocumentsController@change_approve')->name('change_approve');

                Route::get('gst/copyofreturns/{id}', 'CopyofreturnsController@index')->name('copyofreturnslist');
                Route::post('gst/download/copyofreturns/file/{id}', 'CopyofreturnsController@adminusercopyofreturnsFile')->name('adminusercopyofreturnsFile');
                Route::post('gst/gettradename', 'CopyofreturnsController@getTradeName')->name('gettradename');
                Route::post('gst/copyofreturns/create/{id}', 'CopyofreturnsController@create')->name('copyofreturns.create');
                Route::get('gst/copyofreturns/delete/{id}', 'CopyofreturnsController@delete')->name('copyofreturns.delete');

                // gst profile details
                Route::get('gsttype/details/{id}', 'UserGstController@gstProfile')->name('gstTypeDetails');
                Route::post('gst/files/{id}', 'UserGstController@downloadGstFile')->name('downloadGstFile');

                // Display all form related to this user on registration tab
                Route::get('forms/dashboard/details/{id}', 'FormsDashboardController@index')->name('form_dashboard');
                Route::post('forms/change_status', 'FormsDashboardController@change_status')->name('form_dashboard_change_status');
                Route::get('forms/statusview', 'FormsDashboardController@statusview')->name('form_statusView');
                Route::post('forms/additional/file/{id}', 'FormsDashboardController@additionalFile')->name('form_additionalFile');
                Route::post('forms/approved/file/{id}', 'FormsDashboardController@approvedFile')->name('form_approvedFile');
                Route::get('forms/details/{name}/{id1}', 'FormsDashboardController@allProfile')->name('allformProfile');
                Route::post('files/{id}', 'FormsDashboardController@allProfileDocDownload')->name('allprofiledocdownload');

                // Display all form related to this user on Companies Act tab
                Route::get('companiesact/dashboard/details/{id}', 'CompaniesActDashboardController@index')->name('companiesact_dashboard');
                Route::post('companiesact/change_status', 'CompaniesActDashboardController@change_status')->name('companiesact_dashboard_change_status');
                Route::get('companiesact/statusview', 'CompaniesActDashboardController@statusview')->name('companiesact_statusView');
                Route::post('companiesact/additional/file/{id}', 'CompaniesActDashboardController@additionalFile')->name('companiesact_additionalFile');
                Route::post('companiesact/approved/file/{id}', 'CompaniesActDashboardController@approvedFile')->name('companiesact_approvedFile');
                Route::get('companiesact/details/{name}/{id1}', 'CompaniesActDashboardController@allProfile')->name('companiesact_allformProfile');
                Route::post('companiesact/{id}', 'CompaniesActDashboardController@allProfileDocDownload')->name('companiesact_allprofiledocdownload');

                // Display all form related to this user on Certification
                Route::get('certification/dashboard/details/{id}', 'CertificationDashboardController@index')->name('certification_dashboard');
                Route::post('certification/change_status', 'CertificationDashboardController@change_status')->name('certification_dashboard_change_status');
                Route::get('certification/statusview', 'CertificationDashboardController@statusview')->name('certification_statusView');
                Route::post('certification/additional/file/{id}', 'CertificationDashboardController@additionalFile')->name('certification_additionalFile');
                Route::post('certification/approved/file/{id}', 'CertificationDashboardController@approvedFile')->name('certification_approvedFile');
                Route::get('certification/details/{name}/{id1}', 'CertificationDashboardController@allProfile')->name('certification_allformProfile');
                Route::post('certification/{id}', 'CertificationDashboardController@allProfileDocDownload')->name('certification_allprofiledocdownload');

                // Display all form related to this user on Legal Work
                Route::get('legal-work/dashboard/details/{id}', 'LegalWorkDashboardController@index')->name('legal_dashboard');
                Route::post('legal-work/change_status', 'LegalWorkDashboardController@change_status')->name('legal_dashboard_change_status');
                Route::get('legal-work/statusview', 'LegalWorkDashboardController@statusview')->name('legal_statusView');
                Route::post('legal-work/additional/file/{id}', 'LegalWorkDashboardController@additionalFile')->name('legal_additionalFile');
                Route::post('legal-work/approved/file/{id}', 'LegalWorkDashboardController@approvedFile')->name('legal_approvedFile');
                Route::get('legal-work/details/{id1}', 'LegalWorkDashboardController@allProfile')->name('legal_allformProfile');
                Route::post('legal-work/{id}', 'LegalWorkDashboardController@allProfileDocDownload')->name('legal_allprofiledocdownload');

                // Display all form related to this user on Legal Work
                Route::get('loan-finance/dashboard/details/{id}', 'LoanDashboardController@index')->name('loan_dashboard');
                Route::post('loan-finance/change_status', 'LoanDashboardController@change_status')->name('loan_dashboard_change_status');
                Route::get('loan-finance/statusview', 'LoanDashboardController@statusview')->name('loan_statusView');
                Route::post('loan-finance/additional/file/{id}', 'LoanDashboardController@additionalFile')->name('loan_additionalFile');
                Route::post('loan-finance/approved/file/{id}', 'LoanDashboardController@approvedFile')->name('loan_approvedFile');
                Route::get('loan-finance/details/{name}/{id}', 'LoanDashboardController@allProfile')->name('loan_allformProfile');
                Route::post('loan-finance/{id}', 'LoanDashboardController@allProfileDocDownload')->name('loan_allprofiledocdownload');

                //User Payments
                Route::get('payments/{userId}', 'PaymentController@userPaymentDetails');
            });

            Route::get('employee/all', 'UserController@allEmployees');
            //Edit Employee
            Route::get('edit-employee/{id}', 'UserController@editEmployeeForm');
            Route::post('editEmployee/{id}', 'UserController@editEmployee');
            Route::get('delete-employee/{id}', 'UserController@deleteEmployee');
            
            Route::get('payment/history', 'PaymentController@allTransactions');
            Route::get('payment/form-value', 'PaymentController@showFormValue');
            Route::post('payment/update-form-value', 'PaymentController@updateFormValue');
            Route::group(['prefix' => 'forms'], function () {
                Route::get('/PAN', 'AdminController@form_list');
                Route::get('/TAN', 'AdminController@form_list');
                Route::get('/GST', 'AdminController@form_list');
                Route::get('/EPF', 'AdminController@form_list');
                Route::get('/ESIC', 'AdminController@form_list');
                Route::get('/trademark', 'AdminController@form_list');
                Route::get('/company', 'AdminController@form_list');
                Route::get('/partnership', 'AdminController@form_list');
                Route::get('/HUF', 'AdminController@form_list');
                Route::get('/trust', 'AdminController@form_list');
                Route::get('/udamy', 'AdminController@form_list');
                Route::get('/trust', 'AdminController@form_list');
                Route::get('/import-export', 'AdminController@form_list');
                Route::get('/labour', 'AdminController@form_list');
                Route::get('/shop', 'AdminController@form_list');
                Route::get('/ISO', 'AdminController@form_list');
                Route::get('/ISI', 'AdminController@form_list');
                Route::get('/FSSAI', 'AdminController@form_list');
                Route::get('/factory-license', 'AdminController@form_list');
                Route::get('/ITR', 'AdminController@form_list');
                Route::get('/TDS', 'AdminController@form_list');
                Route::get('/tax-audit', 'AdminController@form_list');
                Route::get('/statutory-audit', 'AdminController@form_list');
                Route::get('/DIN-KYC', 'AdminController@form_list');
                Route::get('/AOC', 'AdminController@form_list');
                Route::get('/MGT', 'AdminController@form_list');
                Route::get('/ADT', 'AdminController@form_list');
                Route::get('/minute', 'AdminController@form_list');
                Route::get('/legal-form', 'AdminController@form_list');
                Route::get('/estimated', 'AdminController@form_list');
                Route::get('/project-report', 'AdminController@form_list');
                Route::get('/CMA', 'AdminController@form_list');
                Route::get('/CA', 'AdminController@form_list');
                Route::get('/net-worth', 'AdminController@form_list');
                Route::get('/turnover', 'AdminController@form_list');
            });
            Route::group(['prefix' => 'status'], function () {
                Route::get('{status}', 'AdminController@status_list');
            });
            // Route::get('gst/statusview/{id}', 'UserGstController@statusview')->name('gstStatusView');
        });
    },
);
