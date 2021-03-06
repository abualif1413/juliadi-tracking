<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\CashAccount;
use App\CashTopUp;
use App\AppFunction\Common;

class CashTopUpController extends Controller
{
    public function Index() {
    	$cashAccount = CashAccount::orderBy('CashAccountName', 'ASC')->get();
		$cashTopUpData = DB::select(
			"
				SELECT
					ct.CashTopUpID, ca.CashAccountName, ct.TopUpDate, ct.Amount, ct.Remark
				FROM
					cashtopup ct
					LEFT JOIN cashaccount ca ON ct.CashAccountID = ca.CashAccountID
				ORDER BY
					ct.TopUpDate DESC, ct.CashTopUpID ASC
			",
			array()
		);
		
    	return view('cashtopup.Index', array(
    		'cashAccount' 	=> $cashAccount,
    		'cashTopUpData'	=> $cashTopUpData
		));
    }
	
	public function AddTopUp(Request $request) {
		if($request->submitType == "add") {
			$cashTopUp = new CashTopUp;
			$cashTopUp->CashAccountID = $request->CashAccountID;
			$cashTopUp->Amount = Common::clearNumberFormat($request->Amount);
			$cashTopUp->TopUpDate = $request->TopUpDate;
			$cashTopUp->Remark = $request->Remark;
			$cashTopUp->save();
			
			return \Redirect('CashTopUp');
		} elseif($request->submitType == "update") {
			$cashTopUpID = Crypt::decryptString($request->CashTopUpID);
			$cashTopUp = CashTopUp::find($cashTopUpID);
			$cashTopUp->CashAccountID = $request->CashAccountID;
			$cashTopUp->Amount = Common::clearNumberFormat($request->Amount);
			$cashTopUp->TopUpDate = $request->TopUpDate;
			$cashTopUp->Remark = $request->Remark;
			$cashTopUp->save();
			
			return \Redirect('CashTopUp');
		}
	}

	public function GoEdit(Request $request) {
		$cashTopUpID = Crypt::decryptString($request->CashTopUpID);
		$cashTopUp = CashTopUp::find($cashTopUpID);

		return response(json_encode($cashTopUp))
				->withHeaders([
					'Content-Type' => 'application/json'
				]);
	}

	public function GoDelete($cashTopUpId) {
		$cashTopUpID = Crypt::decryptString($cashTopUpId);
		$cashTopUp = CashTopUp::find($cashTopUpID);
		$cashTopUp->delete();

		return \Redirect('CashTopUp');
	}
}
