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
        //echo "btn submit = " . $request->get("btn_submit");
        //exit;
        if($request->get("dataProcessType") == "add") {
            $employee = new Employee;
            $employee->EmployeeName = $request->get("employeeName");
            $employee->EmployeePosition = $request->get("employeePosition");
            $employee->EmployeePhoneNumber = $request->get("employeePhoneNumber");
            $employee->EmployeeAddress = $request->get("employeeAddress");
            $employee->WorkSiteID = $request->get("employeeSiteId");
            $employee->save();
        } elseif ($request->get("dataProcessType") == "update") {
            $employee = Employee::findOrFail($request->get("employeeId"));
            $employee->EmployeeName = $request->get("employeeName");
            $employee->EmployeePosition = $request->get("employeePosition");
            $employee->EmployeePhoneNumber = $request->get("employeePhoneNumber");
            $employee->EmployeeAddress = $request->get("employeeAddress");
            $employee->WorkSiteID = $request->get("employeeSiteId");
            $employee->save();
        }
        

        return \Redirect::to("/EmployeeMaster");
    }

    public function GoEditEmployee(Request $request) {
        $employee = Employee::find($request->get("EmployeeID"));

        return json_encode($employee);
    }

    public function GoDeleteEmployee($EmployeeID) {
        $employee = Employee::find($EmployeeID);
        $employee->delete();

        return \Redirect::to("/EmployeeMaster");
    }
}
