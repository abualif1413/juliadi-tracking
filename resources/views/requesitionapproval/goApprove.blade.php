@extends('layout.app')

@section('content')
<header> 
    <h1 class="h3 display"><i class="fa fa-sign-in fa-lg">&nbsp;</i> Approval Pengeluaran</h1>
</header>

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h4><i class="fa fa-mail-forward">&nbsp;</i> Data Pengajuan Pengeluaran</h4>
    </div>
    <div class="card-body">
         <div class="row">
            <div class="col-lg-3">Nama Karyawan</div>
            <div class="col-lg-9 text-bold">{{ $unApprovedRequest->EmployeeName }}</div>
         </div>
         <div class="row">
            <div class="col-lg-3">Tgl. Aju</div>
            <div class="col-lg-9 text-bold">{{ \Carbon\Carbon::parse($unApprovedRequest->RequestDate)->format('d/m/Y') }}</div>
         </div>
         <div class="row">
            <div class="col-lg-3">Jumlah</div>
            <div class="col-lg-9 text-bold">{{ number_format($unApprovedRequest->Amount, 2) }}</div>
         </div>
         <div class="row">
            <div class="col-lg-3">Akun Kas</div>
            <div class="col-lg-9 text-bold">{{ $unApprovedRequest->CashAccountName }}</div>
         </div>
         <div class="row">
            <div class="col-lg-3">Keterangan / Uraian Aju</div>
            <div class="col-lg-9 text-bold">{{ $unApprovedRequest->Remark }}</div>
         </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <form method="post" action="{{ url('/RequesitionApproval/ApproveTrue') }}" id="frmApproveTrue">
            @csrf()
            <input type="hidden" name="requesitionSlipID" value="{{ $requesitionSlipID }}" />
            <div class="card">
                <div class="card-header d-flex align-items-center bg-primary text-white">
                    <h4><i class="fa fa-mail-forward">&nbsp;</i> Pengeluaran disetujui</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-control-label">Catatan</label>
                        <textarea class="form-control" name="RemarkTrue" id="RemarkTrue"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary"><i class="fa fa-save">&nbsp;</i> Klik jika pengeluaran disetujui</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-6">
        <form method="post" action="{{ url('/RequesitionApproval/ApproveFalse') }}" id="frmApproveFalse">
            @csrf()
            <input type="hidden" name="requesitionSlipID" value="{{ $requesitionSlipID }}" />
            <div class="card">
                <div class="card-header d-flex align-items-center bg-warning">
                    <h4><i class="fa fa-mail-forward">&nbsp;</i> Pengeluaran tidak disetujui</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-control-label">Catatan</label>
                        <textarea class="form-control" name="RemarkFalse" id="RemarkFalse"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-warning"><i class="fa fa-save">&nbsp;</i> Klik jika pengeluaran tidak disetujui</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(function() {
        formJqValidation(
            $("#frmApproveTrue"),
            {
                RemarkTrue : {
                    required : true
                }
            },
            {
                RemarkTrue : {
                    required : "Harap isikan catatan"
                }
            },
            function(form) {
                sweetConfirm(
                    "Konfirmasi penyetujuan",
                    "Anda yakin akan menyetujui pengeluaran ini?", 
                    function() {
                        form.submit();
                    }, 
                    function() {}
                );
            }
        );

        formJqValidation(
            $("#frmApproveFalse"),
            {
                RemarkFalse : {
                    required : true
                }
            },
            {
                RemarkFalse : {
                    required : "Harap isikan catatan"
                }
            },
            function(form) {
                sweetConfirm(
                    "Konfirmasi penyetujuan",
                    "Anda yakin akan menolak pengeluaran ini?", 
                    function() {
                        form.submit();
                    }, 
                    function() {}
                );
            }
        );
    });
</script>
@endsection