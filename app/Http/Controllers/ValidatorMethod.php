<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Employee;
use App\WorkSite;
use App\EmployeeUserAccount;

class ValidatorMethod extends Controller
{
    public function UniqueUserName(Request $request) {
        $usernameToBeTaken = $request->username;
        $employeeUserAccount = EmployeeUserAccount::where('Username', $usernameToBeTaken)->get();
        $isTaken = 0;
        foreach($employeeUserAccount as $empl) {
            $isTaken++;
        }

        return $isTaken;
    }
}
