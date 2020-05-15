<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\WorkSite;
use App\Employee;

class EmployeeMasterController extends Controller
{
    public function Index() {
        $workSites = WorkSite::all();
        $employees = DB::table('Employee')
                        ->leftJoin('WorkSite', 'Employee.WorkSiteID', '=', 'WorkSite.WorkSiteID')
                        ->orderBy('Employee.EmployeeName', 'asc')
                        ->select('Employee.*', 'WorkSite.WorkSiteName')
                        ->get();
        
        return view('employeemaster.index', [
            "workSites" => $workSites,
            "employees" => $employees
        ]);
    }

    public function AddEmployee(Request $request) {
        $employee = new Employee;
        $employee->EmployeeName = $request->get("employeeName");
        $employee->EmployeePosition = $request->get("employeePosition");
        $employee->EmployeePhoneNumber = $request->get("employeePhoneNumber");
        $employee->EmployeeAddress = $request->get("employeeAddress");
        $employee->WorkSiteID = $request->get("employeeSiteId");
        $employee->save();

        return \Redirect::to("/EmployeeMaster");
    }
}
