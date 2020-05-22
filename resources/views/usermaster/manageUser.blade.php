@extends('layout.app')

@section('content')
<header> 
    <h1 class="h3 display"><i class="fa fa-address-book-o fa-lg">&nbsp;</i> Kelola Pengguna Karyawan</h1>
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

<form method="post" action="{{ url('/UserMaster/ChangeUserName') }}" autocomplete="off" id="frmChangeUsername">
    @csrf
    <input type="hidden" name="encryptedEmployeeID" value="{{ $encryptedEmployeeID }}" />
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4><i class="fa fa-users">&nbsp;</i> Ubah username</h4>
        </div>
        <div class="card-body">
            <div class="col-lg-6">
                <label class="form-control-label">Username baru</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ $employeeUserAccount->Username }}" autocomplete="nope" />
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="btn_submit" value="add"><i class="fa fa-save">&nbsp;</i> Simpan</button>
        </div>
    </div>
</form>

<form method="post" action="{{ url('/UserMaster/ChangePassword') }}" autocomplete="off" id="frmChangePassword">
    @csrf
    <input type="hidden" name="encryptedEmployeeID" value="{{ $encryptedEmployeeID }}" />
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4><i class="fa fa-users">&nbsp;</i> Ubah password</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 form-group">
                    <label class="form-control-label">Password Baru</label>
                    <input type="password" name="passw1" id="passw1" class="form-control" value="" autocomplete="new-password" />
                </div>
                <div class="col-lg-6 form-group">
                    <label class="form-control-label">Ulangi Password Baru</label>
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
        /* ---------------------------- Show message if there is any success message ----------------------- */
        @if($success != "")
            sweetAlert("Informasi", "{!! $success !!}");
        @endif
        /* ---------------------------- Show message if there is any success message ----------------------- */

        /* ----------------------------- Validating change username form ----------------------------------- */
        formJqValidation(
            // Form element
            $("#frmChangeUsername"),

            // Rules
            {
                username : {
                    required : true,
                    minlength : 3,
                    uniqueUserName : true
                }
            },

            // Messages
            {
                username : {
                    required : "Harap isikan username",
                    minlength : "Panjang username minimal 3 karakter",
                    uniqueUserName : "Username telah digunakan atau merupakan username lama, silahkan ganti"
                }
            },

            // Submit handler
            function(form) {
                sweetConfirm(
                    // Text
                    "Konfirmasi penyimpanan",

                    // Message
                    "Anda yakin akan mengubah <i>username</i> untuk<br /><b>{{ $employee->EmployeeName }}</b>", 

                    // Yes callback
                    function() {
                        form.submit();
                    }, 

                    // No callback
                    function() {}
                );
            }
        );
        /* ----------------------------- Validating change username form ----------------------------------- */

        /* ----------------------------- Validating change password form ----------------------------------- */
        formJqValidation(
            // Form element
            $("#frmChangePassword"),

            // Rules
            {
                passw1 : {
                    required : true,
                    minlength : 3
                },
                passw2 : {
                    required : true,
                    minlength : 3,
                    equalTo: "#passw1"
                }
            },

            // Messages
            {
                passw1 : {
                    required : "Harap isikan password",
                    minlength : "Panjang password minimal 3 karakter"
                },
                passw2 : {
                    required : "Harap isikan password sekali lagi",
                    minlength : "Panjang password minimal 3 karakter",
                    equalTo : "Password harus sama dengan password yang diinput di sebelah"
                }
            },

            // Submit handler
            function(form) {
                sweetConfirm(
                    // Text
                    "Konfirmasi penyimpanan",

                    // Message
                    "Anda yakin akan mengubah <i>password</i> untuk<br /><b>{{ $employee->EmployeeName }}</b>", 

                    // Yes callback
                    function() {
                        form.submit();
                    }, 

                    // No callback
                    function() {}
                );
            }
        );
        /* ----------------------------- Validating change password form ----------------------------------- */
    });
</script>
@endsection
