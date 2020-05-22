<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Employee;
use App\WorkSite;
use App\EmployeeUserAccount;

class LoginController extends Controller
{
    public function Index() {
        return view('login.index');
    }

    public function LoginAttemp(Request $request) {
        $username = $request->loginUsername;
        $password = $request->loginPassword;

        $successLogin = 0;

        /// If super admin was logged in
        if($username == "root" && $password == "sa") {
            $successLogin = 1;
            session([
                'EmployeeID' => 'root',
                'EmployeeName' => 'Root',
                'EmployeePosition' => 'Super Admin'
            ]);
        } 
        /// If non super admin 
        else {
            $auth = DB::table('employeeUserAccount')
                        ->leftJoin('employee', 'employeeUserAccount.EmployeeID', '=', 'employee.EmployeeID')
                        ->where('Username', $username)
                        ->where('Password', $password)
                        ->select('employeeUserAccount.*', 'employee.EmployeeName', 'employee.EmployeePosition')
                        ->get();
            if(count($auth) > 0) {
                $successLogin = 1;
                session([
                    'EmployeeID' => $auth[0]->EmployeeID,
                    'EmployeeName' => $auth[0]->EmployeeName,
                    'EmployeePosition' => $auth[0]->EmployeePosition
                ]);
            } else {
                $successLogin = 0;
            }

        }

        return \Redirect('/');
    }

    public function Logout() {
        session()->flush();

        return \Redirect('/');
    }
}
