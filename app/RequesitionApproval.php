<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RequesitionApproval extends Model
{
    protected $table = "requesitionApproval";
    protected $primaryKey = "RequesitionApprovalID";
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    public static function getUnApprovedRequest() {
        /*$unApprovedRequest =
            DB::ra('requesitionSlip')
                ->leftJoin('requesitionApproval', 'requesitionSlip.RequesitionSlipID', '=', 'requesitionSlip.RequesitionSlipID')
                ->leftJoin('employee', 'requesitionSlip.EmployeeID', '=', 'employee.EmployeeID')
                ->leftJoin('cashAccount', 'requesitionSlip.CashAccountID', '=', 'cashAccount.CashAccountID')
                ->whereNull('requesitionApproval.RequesitionSlipID')
                ->orderBy('requesitionSlip.RequesitionSlipID', 'ASC')
                ->select('requesitionSlip.RequesitionSlipID', 'employee.EmployeeName', 'requesitionSlip.RequestDate', 'requesitionSlip.Amount', 'cashAccount.CashAccountName', 'requesitionSlip.Remark')
                ->get();*/
        
        $unApprovedRequest = DB::select(
            "
                SELECT
                    rs.RequesitionSlipID, emp.EmployeeName, rs.RequestDate,
                    rs.Amount, ca.CashAccountName, rs.Remark
                FROM
                    requesitionslip rs
                    LEFT JOIN requesitionapproval rsa ON rs.RequesitionSlipID = rsa.RequesitionSlipID
                    LEFT JOIN employee emp ON rs.EmployeeID = emp.EmployeeID
                    LEFT JOIN cashaccount ca ON rs.CashAccountID = ca.CashAccountID
                WHERE
                    rsa.RequesitionSlipID IS NULL
                ORDER BY
                    rs.RequesitionSlipID ASC
        
            "
        );

        return $unApprovedRequest;
    }

    public static function getUnApprovedRequestFind($RequesitionSlipID) {
        $unApprovedRequest =
            DB::table('requesitionSlip')
                ->leftJoin('requesitionApproval', 'requesitionSlip.RequesitionSlipID', '=', 'requesitionSlip.RequesitionSlipID')
                ->leftJoin('employee', 'requesitionSlip.EmployeeID', '=', 'employee.EmployeeID')
                ->leftJoin('cashAccount', 'requesitionSlip.CashAccountID', '=', 'cashAccount.CashAccountID')
                ->where('requesitionSlip.RequesitionSlipID', $RequesitionSlipID)
                ->orderBy('requesitionSlip.RequesitionSlipID', 'ASC')
                ->select('requesitionSlip.RequesitionSlipID', 'employee.EmployeeName', 'requesitionSlip.RequestDate', 'requesitionSlip.Amount', 'cashAccount.CashAccountName', 'requesitionSlip.Remark')
                ->first();

        return $unApprovedRequest;
    }

    public static function approveRequestTrue($requesitionSlipID, $remark) {
        $requesitionApproval = new RequesitionApproval;
        $requesitionApproval->RequesitionSlipID = $requesitionSlipID;
        $requesitionApproval->IsApprove = "y";
        $requesitionApproval->Remark = $remark;
        $requesitionApproval->save();
    }

    public static function approveRequestFalse($requesitionSlipID, $remark) {
        $requesitionApproval = new RequesitionApproval;
        $requesitionApproval->RequesitionSlipID = $requesitionSlipID;
        $requesitionApproval->IsApprove = "n";
        $requesitionApproval->Remark = $remark;
        $requesitionApproval->save();
    }
}
