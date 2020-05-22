<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\AppFunction\Common;
use App\CashAccount;

class CashAccountMasterController extends Controller
{
    public function Index() {
        $cashAccount = CashAccount::orderBy('CashAccountName', 'ASC')->get();

        return view('cashaccountmaster.index', [
            'cashAccount'   => $cashAccount
        ]);
    }

    public function AddAccount(Request $request) {
        if($request->submitType == "add") {
            $cashAccount = new CashAccount;
            $cashAccount->CashAccountName = $request->CashAccountName;
            $cashAccount->StartedAt = $request->StartedAt;
            $cashAccount->openingBallance = Common::clearNumberFormat($request->OpeningBallance);
            $cashAccount->save();
        } elseif($request->submitType == "update") {
            $cashAccountID = Crypt::decryptString($request->CashAccountID);
            $cashAccount = CashAccount::find($cashAccountID);
            $cashAccount->CashAccountName = $request->CashAccountName;
            $cashAccount->StartedAt = $request->StartedAt;
            $cashAccount->openingBallance = Common::clearNumberFormat($request->OpeningBallance);
            $cashAccount->save();
        }
        
        return \Redirect("/CashAccountMaster");
    }

    public function GoEdit(Request $request) {
        $cashAccountID = Crypt::decryptString($request->CashAccountID);
        $cashAccount = CashAccount::find($cashAccountID);

        return json_encode($cashAccount);
    }

    public function GoDelete($CashAccountID) {
        $cashAccountID = Crypt::decryptString($CashAccountID);
        $cashAccount = CashAccount::find($cashAccountID);
        $cashAccount->delete();

        return \Redirect("/CashAccountMaster");
    }
}
