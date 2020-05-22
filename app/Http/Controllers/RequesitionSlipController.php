<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppFunction\Common;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\CashAccount;
use App\RequesitionSlip;

class RequesitionSlipController extends Controller
{
    public function Index() {
        $cashAccount = CashAccount::orderBy('CashAccountName', 'asc')->get();
		$requesitionData = DB::select(
			"
				SELECT
						rs.*, ca.CashAccountName, em.EmployeeName,
						COALESCE(ra.IsApprove, '') AS IsApprove, ra.Remark AS ApprovalRemark, ra.CreatedAt AS ApprovalDate
					FROM
						requesitionslip rs
						LEFT JOIN cashaccount ca ON rs.CashAccountID = ca.CashAccountID
						LEFT JOIN employee em ON rs.EmployeeID = em.EmployeeID
						LEFT JOIN requesitionapproval ra ON rs.RequesitionSlipID = ra.RequesitionSlipID
					WHERE
						rs.EmployeeID = ?
					ORDER BY
						rs.RequestDate DESC, rs.RequesitionSlipID ASC
			", [session('EmployeeID')]
		);

        return view('requesitionslip.index', [
            'cashAccount'       => $cashAccount,
            'requesitionData'   => $requesitionData
        ]);
    }

    public function AddReceipt(Request $request) {
        if($request->submitType == "add") {
            $requesitionSlip = new RequesitionSlip();
            $requesitionSlip->EmployeeID = session('EmployeeID');
            $requesitionSlip->CashAccountID = $request->CashAccountID;
            $requesitionSlip->RequestDate = $request->RequestDate;
            $requesitionSlip->Amount = Common::clearNumberFormat($request->Amount);
            $requesitionSlip->Remark = $request->Remark;
            $requesitionSlip->save();
        } elseif($request->submitType == "update") {
            $requesitionSlipID = crypt::decryptString($request->RequesitionSlipID);
            $requesitionSlip = RequesitionSlip::find($requesitionSlipID);
            $requesitionSlip->EmployeeID = session('EmployeeID');
            $requesitionSlip->CashAccountID = $request->CashAccountID;
            $requesitionSlip->RequestDate = $request->RequestDate;
            $requesitionSlip->Amount = Common::clearNumberFormat($request->Amount);
            $requesitionSlip->Remark = $request->Remark;
            $requesitionSlip->save();
        }

        return \Redirect('/RequesitionSlip');
    }

    public function GoEdit(Request $request) {
        $requesitionSlipID = Crypt::decryptString($request->RequesitionSlipID);

        $requesitionSlip = RequesitionSlip::find($requesitionSlipID);

        return json_encode($requesitionSlip);
    }

    public function GoDelete($encID) {
        $requesitionSlipID = Crypt::decryptString($encID);

        $requesitionSlip = RequesitionSlip::find($requesitionSlipID);
        $requesitionSlip->delete();

        return \Redirect('/RequesitionSlip');
    }
}
