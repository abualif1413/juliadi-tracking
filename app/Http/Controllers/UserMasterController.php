<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Employee;
use App\WorkSite;
use App\EmployeeUserAccount;

class UserMasterController extends Controller
{
    public function Index() {
        $employees = DB::table('Employee')
                        ->leftJoin('WorkSite', 'Employee.WorkSiteID', '=', 'WorkSite.WorkSiteID')
                        ->leftJoin('employeeUserAccount', 'Employee.EmployeeID', '=', 'employeeUserAccount.EmployeeID')
                        ->orderBy('Employee.EmployeeName', 'asc')
                        ->select('Employee.*', 'WorkSite.WorkSiteName', 'employeeUserAccount.EmployeeID AS EmployeeIDAccount', 'employeeUserAccount.Active')
                        ->get();
        
        return view('usermaster.index', [
            "employees" => $employees
        ]);
    }

    public function CreateUser($EncryptedEmployeeID) {
        $EmployeeID = Crypt::decryptString($EncryptedEmployeeID);
        $employee = Employee::findOrFail($EmployeeID);
        $workSite = WorkSite::findOrFail($employee->WorkSiteID);

        return view('usermaster.createUser', [
            "employee" => $employee,
            "workSite" => $workSite,
            "encryptedEmployeeID" => $EncryptedEmployeeID
        ]);
    }

    public function CreateUserAccount(Request $request) {
        $EmployeeID = Crypt::decryptString($request->EncryptedEmployeeID);

        $employeeUserAccountFind = EmployeeUserAccount::find($EmployeeID);
        if($employeeUserAccountFind != null) {
            $employeeUserAccountFind->delete();
        }

        $employeeUserAccount = new EmployeeUserAccount;
        $employeeUserAccount->EmployeeID = $EmployeeID;
        $employeeUserAccount->Username = $request->username;
        $employeeUserAccount->Password = $request->passw1;
        $employeeUserAccount->save();

        return \Redirect::to("/UserMaster");
    }

    public function ManageUser(Request $request, $EncryptedEmployeeID) {
        $EmployeeID = Crypt::decryptString($EncryptedEmployeeID);
        $employee = Employee::findOrFail($EmployeeID);
        $workSite = WorkSite::findOrFail($employee->WorkSiteID);
        $employeeUserAccount = EmployeeUserAccount::findOrFail($EmployeeID);

        return view('usermaster.manageUser', [
            "employee" => $employee,
            "workSite" => $workSite,
            "employeeUserAccount" => $employeeUserAccount,
            "encryptedEmployeeID" => $EncryptedEmployeeID,
            "success" => $request->success
        ]);
    }

    public function SwitchUserStatus(Request $request) {
        $employeeID = Crypt::decryptString($request->EmployeeID);

        $employeeUserAccount = EmployeeUserAccount::find($employeeID);
        $employee = Employee::find($employeeID);
        if($employeeUserAccount != null && $employee != null) {
            $responseMessage = ($employeeUserAccount->Active == "y") ? "Telah me non-aktifkan akun untuk <b>" . $employee->EmployeeName . "</b>" : "Telah meng-aktifkan akun untuk <b>" . $employee->EmployeeName . "</b>";
            $employeeUserAccount->Active = ($employeeUserAccount->Active == "y") ? "n" : "y";
            $employeeUserAccount->save();

            return $responseMessage;
        } else {
            return "0";
        }
    }

    public function ChangeUserName(Request $request) {
        $employeeID = Crypt::decryptString($request->encryptedEmployeeID);
        $employeeUserAccount = EmployeeUserAccount::findOrFail($employeeID);
        $employee = Employee::findOrFail($employeeID);
        $employeeUserAccount->Username = $request->username;
        $employeeUserAccount->save();

        return \Redirect::to("/UserMaster/ManageUser/" . $request->encryptedEmployeeID . "?success=Username untuk <b>" . $employee->EmployeeName . "</b> telah dibah");
    }

    public function ChangePassword(Request $request) {
        $employeeID = Crypt::decryptString($request->encryptedEmployeeID);
        $employeeUserAccount = EmployeeUserAccount::findOrFail($employeeID);
        $employee = Employee::findOrFail($employeeID);
        $employeeUserAccount->Password = $request->passw1;
        $employeeUserAccount->save();

        return \Redirect::to("/UserMaster/ManageUser/" . $request->encryptedEmployeeID . "?success=Password untuk <b>" . $employee->EmployeeName . "</b> telah dibah");
    }
}
