@extends('layout.app')

@section('content')
<header> 
    <h1 class="h3 display"><i class="fa fa-mail-reply fa-lg">&nbsp;</i> Tambah Saldo</h1>
</header>

<form method="post" action="{{ url('/CashTopUp/AddTopUp') }}" id="frmTopUp" onreset="goReset();">
    @csrf()
    <input type="hidden" name="CashTopUpID" id="CashTopUpID" />
    <input type="hidden" name="submitType" id="submitType" value="add" />
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4><i class="fa fa-file">&nbsp;</i> Form Penambahan Saldo Kas</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5 form-group">
                    <label class="form-control-label">Akun Kas</label>
                    <select name="CashAccountID" id="CashAccountID" class="form-control">
                    	<option value=""></option>
                    	@foreach($cashAccount as $cash)
                    		<option value="{{ $cash->CashAccountID }}">{{ $cash->CashAccountName }}</option>
                    	@endforeach
                    </select>
                </div>
                <div class="col-lg-3 form-group">
                    <label class="form-control-label">Tanggal</label>
                    <input type="text" name="TopUpDate" id="TopUpDate" class="form-control datepicker" />
                </div>
                <div class="col-lg-4 form-group">
                    <label class="form-control-label">Jumlah</label>
                    <input type="text" name="Amount" id="Amount" class="form-control accounting" />
                </div>
            </div>
            <div class="row">
            	<div class="col-lg-12 form-group">
            		<label class="form-control-label">Keterangan</label>
                    <textarea name="Remark" id="Remark" class="form-control"></textarea>
            	</div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" id="btn_save"><i class="fa fa-save">&nbsp;</i> Simpan</button>
            <button class="btn btn-warning" id="btn_reset" style="display: none;" type="reset"><i class="fa fa-refresh">&nbsp;</i> Reset</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h4><i class="fa fa-list">&nbsp;</i> Daftar Riwayat Penambahan Saldo</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover table-sm datatable">
            <thead>
                <tr>
                    <th width="30px"></th>
                    <th width="30px"></th>
                    <th width="30px">No.</th>
                    <th width="200px">Akun Kas</th>
                    <th width="150px">Tanggal</th>
                    <th width="200px">Jumlah</th>
                    <th>Keterangan / Uraian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cashTopUpData as $index => $data)
                	<tr>
                		<td>
                            <button class="btn btn-success btn-sm btn-block" onclick="goEdit('{{ Crypt::encryptString($data->CashTopUpID) }}');"><i class="fa fa-pencil"></i></button>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm btn-block" onclick="goDelete('{{ Crypt::encryptString($data->CashTopUpID) }}');"><i class="fa fa-trash"></i></button>
                        </td>
                		<td>{{ ($index + 1) }}</td>
                		<td>{{ $data->CashAccountName }}</td>
                		<td>{{ \Carbon\Carbon::parse($data->TopUpDate)->format('d/m/Y') }}</td>
                		<td>{{ number_format($data->Amount) }}</td>
                		<td>{{ $data->Remark }}</td>
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
    		$("#frmTopUp"),
    		{
    			CashAccountID : {
    				required : true
    			},
    			TopUpDate : {
    				required : true
    			},
    			Amount : {
    				required : true,
    				number : true
    			},
    			Remark : {
    				required : true,
    				minlength : 10
    			}
    		},
    		{
    			CashAccountID : {
    				required : "Pilih akun kas mana yang akan di tambah saldonya"
    			},
    			TopUpDate : {
    				required : "Pilih tanggal penambahan saldo"
    			},
    			Amount : {
    				required : "Isikan jumlah yang akan ditambah",
    				number : "Jumlah harus angka"
    			},
    			Remark : {
    				required : "Isikan keterangan",
    				minlength : "Keterangan minimal 10 karakter"
    			}
    		},
    		function(form) {
    			sweetConfirm(
    				"Perhatian", "Anda yakin akan menyimpan data penambahan saldo ini?", function() {
    					form.submit();
    				}, function() {}
    			);
    		}
    	);
    });

    function goEdit(cashTopUpId) {
        $.ajax({
            async       : false,
            headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url         : "{{ url('/CashTopUp/GoEdit') }}",
            dataType    : "json",
            type        : "post",
            data        : {CashTopUpID:cashTopUpId},
            success     : function(r) {
                $("#CashAccountID").val(r.CashAccountID);
                $("#Amount").val(r.Amount);
                $("#TopUpDate").val(r.TopUpDate.substring(0, 10));
                $("#Remark").val(r.Remark);
                $("#CashTopUpID").val(cashTopUpId);
                $("#submitType").val("update");
                $("#btn_reset").show();
                window.scrollTo(0, 0);
            }
        });
    }

    function goDelete(cashTopUpId) {
        sweetConfirm(
            "Perhatian", "Anda yakin akan menghapus data ini?",
            function() {
                document.location.href = "{{ url('/CashTopUp/GoDelete') }}/" + cashTopUpId;
            }
        );
    }

    function goReset() {
        $("#submitType").val("add");
        $("#btn_reset").hide();
    }
</script>
@endsection