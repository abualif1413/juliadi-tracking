@extends('layout.app')

@section('content')
<header> 
    <h1 class="h3 display"><i class="fa fa-briefcase fa-lg">&nbsp;</i> Kategori Akun Kas</h1>
</header>

<form method="post" action="{{ url('/CashAccountMaster/AddAccount') }}" id="frmCashAccount">
    @csrf()
    <input type="hidden" name="CashAccountID" id="CashAccountID" />
    <input type="hidden" name="submitType" id="submitType" value="add" />
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4><i class="fa fa-file">&nbsp;</i> Form kategori akun kas</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-9 form-group">
                    <label class="form-control-label">Nama Akun Kas</label>
                    <input type="text" name="CashAccountName" id="CashAccountName" class="form-control" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 form-group">
                    <label class="form-control-label">Berlaku Tgl.</label>
                    <input type="text" name="StartedAt" id="StartedAt" class="form-control datepicker" />
                </div>
                <div class="col-lg-6 form-group">
                    <label class="form-control-label">Saldo Awal</label>
                    <input type="text" name="OpeningBallance" id="OpeningBallance" class="form-control accounting" />
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" id="btn_save"><i class="fa fa-save">&nbsp;</i> Simpan</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h4><i class="fa fa-list">&nbsp;</i> Daftar kategori akun kas</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover table-sm datatable">
            <thead>
                <tr>
                    <th width="30px"></th>
                    <th width="30px"></th>
                    <th width="30px">No.</th>
                    <th>Nama Akun Kas</th>
                    <th width="200px">Tgl. Berlaku</th>
                    <th width="300px">Saldo Awal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cashAccount as $no => $cash)
                    <tr>
                        <td>
                            <button class="btn btn-success btn-sm btn-block" onclick="GoEdit('{{ Crypt::encryptString($cash->CashAccountID) }}');"><i class="fa fa-pencil"></i></button>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm btn-block" onclick="GoDelete('{{ Crypt::encryptString($cash->CashAccountID) }}', '{{ $cash->CashAccountName }}')"><i class="fa fa-trash"></i></button>
                        </td>
                        <td>{{ ($no + 1) }}</td>
                        <td>{{ $cash->CashAccountName }}</td>
                        <td>{{ \Carbon\Carbon::parse($cash->StartedAt)->format('d/m/Y') }}</td>
                        <td>{{ number_format($cash->OpeningBallance, 0) }}</td>
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
            $("#frmCashAccount"),

            // Rules
            {
                CashAccountName : {
                    required : true,
                    minlength : 5
                },
                StartedAt : {
                    required : true
                },
                OpeningBallance : {
                    required : true,
                    number : true
                }
            },

            // Messages
            {
                CashAccountName : {
                    required : "Harap isikan nama akun kas",
                    minlength : "Panjang minimal 5 karakter"
                },
                StartedAt : {
                    required : "Harap tentukan tanggal berlaku"
                },
                OpeningBallance : {
                    required : "Harap isikan saldo awal",
                    number : "Saldo awal harus berupa angka"
                }
            },

            // Submit handler
            function(form) {
                sweetConfirm(
                    // Text
                    "Konfirmasi penyimpanan",

                    // Message
                    "Anda yakin akan menyimpan data kategori akun kas ini?", 

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

    function GoEdit(CashAccountID) {
        $.ajax({
            async       : false,
            headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url         : "{{ url('/CashAccountMaster/GoEdit') }}",
            dataType    : "json",
            type        : "post",
            data        : {CashAccountID:CashAccountID},
            success     : function(r) {
                $("#submitType").val("update");
                $("#CashAccountID").val(CashAccountID);
                $("#CashAccountName").val(r.CashAccountName);
                $("#StartedAt").val(r.StartedAt.substring(0, 10));
                $("#OpeningBallance").val(accounting.format(r.OpeningBallance, 2));
                $("#OpeningBallance").html("<i class='fa fa-save'>&nbsp;</i> Ubah");
                window.scrollTo(0, 0);
            }
        });
    }

    function GoDelete(CashAccountID, CashAccountName) {
        sweetConfirm(
            "Perhatian",
            "Anda yakin akan menghapus kategori akun kas<br /><b>" + CashAccountName + "</b>?",
            function() {
                document.location.href = "{{ url('/CashAccountMaster/GoDelete') }}/" + CashAccountID;
            },
            function() {}
        );
    }
</script>
@endsection