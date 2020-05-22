<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppFunction\Common;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\RequesitionApproval;

class RequesitionApprovalController extends Controller
{
    public function Index() {
        $unApprovedRequest = RequesitionApproval::getUnApprovedRequest();

        return view('requesitionapproval.index', [
            'unApprovedRequest' => $unApprovedRequest
        ]);
    }

    public function GoApprove($requestID) {
        $requesitionSlipID = Crypt::decryptString($requestID);
        $unApprovedRequest = RequesitionApproval::getUnApprovedRequestFind($requesitionSlipID);

        return view('requesitionapproval.goApprove', [
            'unApprovedRequest' => $unApprovedRequest,
            'requesitionSlipID' => $requestID
        ]);
    }

    public function ApproveTrue(Request $request) {
        $requesitionSlipID = Crypt::decryptString($request->requesitionSlipID);
        RequesitionApproval::approveRequestTrue($requesitionSlipID, $request->RemarkTrue);

        return \Redirect("/RequesitionApproval");
    }

    public function ApproveFalse(Request $request) {
        $requesitionSlipID = Crypt::decryptString($request->requesitionSlipID);
        RequesitionApproval::approveRequestFalse($requesitionSlipID, $request->RemarkFalse);

        return \Redirect("/RequesitionApproval");
    }
}
