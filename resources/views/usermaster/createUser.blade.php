@extends('layout.app')

@section('content')
<header> 
    <h1 class="h3 display"><i class="fa fa-address-book-o fa-lg">&nbsp;</i> Buat Akun Pengguna Karyawan</h1>
</header>

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h4><i class="fa fa-users">&nbsp;</i> Data Karyawan</h4>
    </div>
    <div class="card-body">
         <div class="row">
            <div class="col-lg-3">Nama</div>
            <div class="col-lg-9 text-bold">{{ $employee->EmployeeName }}</div>
         </div>
         <div class="row">
            <div class="col-lg-3">Jabatan</div>
            <div class="col-lg-9 text-bold">{{ $employee->EmployeePosition }}</div>
         </div>
         <div class="row">
            <div class="col-lg-3">No. Telepon</div>
            <div class="col-lg-9 text-bold">{{ $employee->EmployeePhoneNumber }}</div>
         </div>
         <div class="row">
            <div class="col-lg-3">Alamat</div>
            <div class="col-lg-9 text-bold">{{ $employee->EmployeeAddress }}</div>
         </div>
         <div class="row">
            <div class="col-lg-3">Unit Kerja</div>
            <div class="col-lg-9 text-bold">{{ $workSite->WorkSiteName }}</div>
         </div>
    </div>
</div>

<form method="post" name="frmCreateUser" id="frmCreateUser" action="{{ url('/UserMaster/CreateUserAccount') }}" autocomplete="off">
    @csrf
    <input type="hidden" name="EncryptedEmployeeID" value="{{ $encryptedEmployeeID }}" />
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4><i class="fa fa-unlock-alt">&nbsp;</i> Setting Akun Pengguna Karyawan</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 form-group">
                    <label class="form-control-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="" autocomplete="nope" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 form-group">
                    <label class="form-control-label">Password</label>
                    <input type="password" name="passw1" id="passw1" class="form-control" value="" autocomplete="new-password" />
                </div>
                <div class="col-lg-6 form-group">
                    <label class="form-control-label">Ulangi Password</label>
                    <input type="password" name="passw2" id="passw2" class="form-control" value="" autocomplete="new-password" />
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="btn_submit" value="add"><i class="fa fa-save">&nbsp;</i> Simpan</button>
        </div>
    </div>
</form>
@endsection

@section('javascript')
<script type="text/javascript">
    $(function() {
        formJqValidation(
            // Form element
            $("#frmCreateUser"),

            // Rules
            {
                username : {
                    required : true,
                    minlength : 3,
                    uniqueUserName : true
                },
                passw1 : {
                    required : true,
                    minlength : 5
                },
                passw2 : {
                    required : true,
                    minlength : 5,
                    equalTo: "#passw1"
                },
            },

            // Messages
            {
                username : {
                    required : "Harap isikan username",
                    minlength : "Panjang username minimal 3 karakter",
                    uniqueUserName : "Username telah digunakan atau merupakan username lama, silahkan ganti"
                },
                passw1 : {
                    required : "Harap isikan password",
                    minlength : "Panjang password minimal 5 karakter"
                },
                passw2 : {
                    required : "Harap isikan password sekali lagi",
                    minlength : "Panjang password minimal 5 karakter",
                    equalTo: "Password ini harus sama dengan password yang sebelumnya diinputkan"
                },
            },

            // Submit handler
            function(form) {
                sweetConfirm(
                    // Text
                    "Konfirmasi penyimpanan",

                    // Message
                    "Anda yakin akan membuat akun untuk<br /><b>{{ $employee->EmployeeName }}</b><br />Anda dapat menon-aktifkan akun karyawan ini dikemudian hari?", 

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
</script>
@endsection
