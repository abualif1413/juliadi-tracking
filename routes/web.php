<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\PreventLoginPage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/Login', 'LoginController@Index')->middleware([PreventLoginPage::class]);
Route::post('/Login/LoginAttemp', 'LoginController@LoginAttemp')->middleware([PreventLoginPage::class]);
Route::get('/Login/Logout', 'LoginController@Logout')->middleware('authLogin');

// This is how to assign middleware one by one each route
Route::get('/', 'HomeController@homePage')->middleware('authLogin');
Route::get('/home', 'HomeController@homePage')->middleware('authLogin');

// And this is how to assign middleware to more than one rout
Route::middleware('authLogin')->group(function() {
    Route::get('/EmployeeMaster', 'EmployeeMasterController@Index');
    Route::post('/EmployeeMaster/AddEmployee', 'EmployeeMasterController@AddEmployee');
    Route::post('/EmployeeMaster/GoEditEmployee', 'EmployeeMasterController@GoEditEmployee');
    Route::get('/EmployeeMaster/GoDeleteEmployee/{EmployeeID}', 'EmployeeMasterController@GoDeleteEmployee');

    Route::get('/UserMaster', 'UserMasterController@Index');
    Route::get('/UserMaster/CreateUser/{EmployeeID}', 'UserMasterController@CreateUser');
    Route::get('/UserMaster/ManageUser/{EmployeeID}', 'UserMasterController@ManageUser');
    Route::post('/UserMaster/CreateUserAccount', 'UserMasterController@CreateUserAccount');
    Route::post('/UserMaster/SwitchUserStatus', 'UserMasterController@SwitchUserStatus');
    Route::post('/UserMaster/ChangeUserName', 'UserMasterController@ChangeUserName');
    Route::post('/UserMaster/ChangePassword', 'UserMasterController@ChangePassword');

    Route::get('/CashAccountMaster', 'CashAccountMasterController@Index');
    Route::post('/CashAccountMaster/AddAccount', 'CashAccountMasterController@AddAccount');
    Route::post('/CashAccountMaster/GoEdit', 'CashAccountMasterController@GoEdit');
    Route::get('/CashAccountMaster/GoDelete/{CashAccountID}', 'CashAccountMasterController@GoDelete');

    Route::get('/RequesitionSlip', 'RequesitionSlipController@Index');
    Route::post('/RequesitionSlip/AddReceipt', 'RequesitionSlipController@AddReceipt');
    Route::post('/RequesitionSlip/GoEdit', 'RequesitionSlipController@GoEdit');
    Route::get('/RequesitionSlip/GoDelete/{RequesitionSlipID}', 'RequesitionSlipController@GoDelete');

    Route::get('/RequesitionApproval', 'RequesitionApprovalController@Index');
    Route::get('/RequesitionApproval/GoApprove/{RequestID}', 'RequesitionApprovalController@GoApprove');
    Route::post('/RequesitionApproval/ApproveTrue', 'RequesitionApprovalController@ApproveTrue');
    Route::post('/RequesitionApproval/ApproveFalse', 'RequesitionApprovalController@ApproveFalse');
	
	Route::get('/CashTopUp', 'CashTopUpController@Index');
	Route::post('/CashTopUp/AddTopUp', 'CashTopUpController@AddTopUp');

    Route::post('/ValidatorMethod/UniqueUserName', 'ValidatorMethod@UniqueUserName');
});

