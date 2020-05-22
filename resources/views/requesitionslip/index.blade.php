@extends('layout.app')

@section('content')
<header> 
    <h1 class="h3 display"><i class="fa fa-mail-forward fa-lg">&nbsp;</i> Pengeluaran Kas</h1>
</header>

<form method="post" action="{{ url('/RequesitionSlip/AddReceipt') }}" id="frmRequesitionSlip" onreset="GoReset();">
    @csrf()
    <input type="hidden" name="RequesitionSlipID" id="RequesitionSlipID" />
    <input type="hidden" name="submitType" id="submitType" value="add" />
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4><i class="fa fa-file">&nbsp;</i> Input Pengeluaran Kas</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 form-group">
                    <label class="form-control-label">Pilih akun kas</label>
                    <select name="CashAccountID" id="CashAccountID" class="form-control">
                        <option value=""></option>
                        @foreach($cashAccount as $cash)
                            <option value="{{ $cash->CashAccountID }}">{{ $cash->CashAccountName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 form-group">
                    <label class="form-control-label">Jumlah</label>
                    <input type="text" name="Amount" id="Amount" class="form-control accounting" />
                </div>
                <div class="col-lg-3 form-group">
                    <label class="form-control-label">Tanggal</label>
                    <input type="text" name="RequestDate" id="RequestDate" class="form-control datepicker" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 form-group">
                    <label class="form-control-label">Keterangan / Uraian</label>
                    <textarea name="Remark" id="Remark" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" type="subbmit" name="btn_save" id="btn_save" class="btn btn-primary"><i class="fa fa-save">&nbsp;</i> Save</button>
            <button class="btn btn-default" type="reset" name="btn_reset" id="btn_reset" style="display: none;"><i class="fa fa-recycle">&nbsp;</i> Reset</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h4><i class="fa fa-list">&nbsp;</i> Daftar Pengeluaran Kas</h4>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-hover table-sm datatable">
            <thead>
                <tr>
                    <th width="40px"></th>
                    <th width="40px"></th>
                    <th width="30px">No.</th>
                    <th width="150px">Tanggal</th>
                    <th width="150px">Jumlah</th>
                    <th width="200px">Akun Kas</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requesitionData as $no => $req)
                    <tr>
                    	@if($req->IsApprove == "y")
                    		<td colspan="2"><button class="btn btn-success btn-sm btn-block" title="Klik untuk melihat keterangan" onclick="SeeRemark('{{ $req->ApprovalRemark }}')"><i class="fa fa-check">&nbsp;</i> Accept</button></td>
                    	@elseif($req->IsApprove == "n")
                    		<td colspan="2"><button class="btn btn-danger btn-sm btn-block" title="Klik untuk melihat keterangan" onclick="SeeRemark('{{ $req->ApprovalRemark }}')"><i class="fa fa-close">&nbsp;</i> Reject</button></td>
                    	@else
	                        <td>
	                            <button class="btn btn-success btn-sm btn-block" onclick="GoEdit('{{ Crypt::encryptString($req->RequesitionSlipID) }}');"><i class="fa fa-pencil"></i></button>
	                        </td>
	                        <td>
	                            <button class="btn btn-warning btn-sm btn-block" onclick="GoDelete('{{ Crypt::encryptString($req->RequesitionSlipID) }}');"><i class="fa fa-trash"></i></button>
	                        </td>
                        @endif
                        <td>{{ ($no + 1) }}</td>
                        <td>{{ \Carbon\Carbon::parse($req->RequestDate)->format('d/m/Y') }}</td>
                        <td>{{ number_format($req->Amount, 2) }}</td>
                        <td>{{ $req->CashAccountName }}</td>
                        <td>{{ $req->Remark }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $(function() {
        formJqValidation(
            // Form element
            $("#frmRequesitionSlip"),

            // Rules
            {
                CashAccountID : {
                    required : true
                },
                Amount : {
                    required : true,
                    number : true
                },
                RequestDate : {
                    required : true
                },
                Remark : {
                    required : true
                }
            },

            // Messages
            {
                CashAccountID : {
                    required : "Pilih akun kas"
                },
                Amount : {
                    required : "Isikan jumlah yang akan diajukan",
                    number : "Jumlah harus angka"
                },
                RequestDate : {
                    required : "Tentukan tanggal pengajuan"
                },
                Remark : {
                    required : "Isikan keterangan / uraian pengeluaran"
                }
            },

            // Submit handler
            function(form) {
                sweetConfirm(
                    // Text
                    "Konfirmasi penyimpanan",

                    // Message
                    "Anda yakin akan menyimpan data permohonan pengeluaran ini?", 

                    // Yes callback
                    function() {
                        form.submit();
                    }, 

                    // No callback
                    function() {}
                );
            }
        );
    });

    function GoEdit(RequesitionSlipID) {
        $.ajax({
            async       : false,
            headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url         : "{{ url('/RequesitionSlip/GoEdit') }}",
            dataType    : "json",
            type        : "post",
            data        : {RequesitionSlipID:RequesitionSlipID},
            success     : function(r) {
                $("#submitType").val("update");
                $("#RequesitionSlipID").val(RequesitionSlipID);
                $("#CashAccountID").val(r.CashAccountID);
                $("#RequestDate").val(r.RequestDate.substring(0, 10));
                $("#Amount").val(accounting.format(r.Amount, 2));
                $("#Remark").val(r.Remark);
                $("#btn_save").html("<i class='fa fa-save'>&nbsp;</i> Ubah");
                $("#btn_reset").show();
                window.scrollTo(0, 0);
            }
        });
    }

    function GoReset() {
        $("#submitType").val("add");
        $("#btn_save").html("<i class='fa fa-save'>&nbsp;</i> Simpan");
        $("#btn_reset").hide();
    }

    function GoDelete(RequesitionSlipID) {
        sweetConfirm(
            "Perhatian", "Anda yakin akan menghapus data pengeluaran ini?",
            function() {
                document.location.href = "{{ url('/RequesitionSlip/GoDelete') }}/" + RequesitionSlipID;
            }, function() {}
        );
    }
    
    function SeeRemark(remark) {
    	sweetAlert("Catatan", remark);
    }
</script>
@endsection