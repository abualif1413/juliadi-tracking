@extends('layout.app')

@section('content')

<header> 
    <h1 class="h3 display"><i class="fa fa-users fa-lg">&nbsp;</i> Data Karyawan</h1>
</header>

<form method="post" id="frmEmployee" action="{!! url('/') !!}/EmployeeMaster/AddEmployee" onreset="ResetForm();">
    @csrf
    <input type="hidden" name="employeeId" id="employeeId" />
    <input type="hidden" name="dataProcessType" id="dataProcessType" value="add" />
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4><i class="fa fa-file">&nbsp;</i> Form data karyawan</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Nama Karyawan</label>
                        <input type="text" name="employeeName" id="employeeName" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Jabatan</label>
                        <input type="text" name="employeePosition" id="employeePosition" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">No. HP</label>
                        <input type="text" name="employeePhoneNumber" id="employeePhoneNumber" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">Alamat</label>
                        <input type="text" name="employeeAddress" id="employeeAddress" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">Unit kerja</label>
                        <select name="employeeSiteId" id="employeeSiteId" class="form-control">
                            <option value=""></option>
                            @foreach($workSites as $sites)
                                <option value="{{ $sites->WorkSiteID }}">{{ $sites->WorkSiteName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div> 
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="btn_submit" value="save" id="btn_simpan"><i class="fa fa-save">&nbsp;</i> Simpan</button>
            <button class="btn btn-success" type="submit" name="btn_submit" value="update" id="btn_ubah" style="display: none;"><i class="fa fa-save">&nbsp;</i> Ubah</button>
            <button class="btn btn-default" type="reset" name="btn_reset" id="btn_reset" style="display: none;"><i class="fa fa-recycle">&nbsp;</i> Reset</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h4><i class="fa fa-list">&nbsp;</i> Daftar Karyawan</h4>
    </div>
    <div class="card-body">
         <table class="table table-striped table-hover table-sm datatable">
            <thead>
                <tr>
                    <th width="30px"></th>
                    <th width="30px"></th>
                    <th width="30px">No.</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Unit Kerja</th>
                    <th>No. HP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $index => $employee)
                    <tr>
                        <td>
                            <button class="btn btn-warning btn-sm btn-block" onclick="GoDeleteEmployee({{ $employee->EmployeeID }});"><i class="fa fa-trash"></i></button>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm btn-block" onclick="GoEditEmployee({{ $employee->EmployeeID }});"><i class="fa fa-pencil"></i></button>
                        </td>
                        <td>{{ ($index+1) }}</td>
                        <td>{{ $employee->EmployeeName }}</td>
                        <td>{{ $employee->EmployeePosition }}</td>
                        <td>{{ $employee->EmployeeAddress }}</td>
                        <td>{{ $employee->WorkSiteName }}</td>
                        <td>{{ $employee->EmployeePhoneNumber }}</td>
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
            $("#frmEmployee"),

            // Rules
            {
                employeeName : {
                    required : true
                },
                employeePosition : {
                    required : true
                },
                employeePhoneNumber : {
                    required : true
                },
                employeeAddress : {
                    required : true
                },
                employeeSiteId : {
                    required : true
                }
            },

            // Messages
            {
                employeeName : {
                    required : "Nama harap diisi"
                },
                employeePosition : {
                    required : "Jabatan harap diisi"
                },
                employeePhoneNumber : {
                    required : "Nomor telepon / hp harap diisi"
                },
                employeeAddress : {
                    required : "Alamat harap diisi"
                },
                employeeSiteId : {
                    required : "Unit kerja harap dipilih"
                }
            },

            // Submit handler
            function(form) {
                sweetConfirm(
                    // Text
                    "Konfirmasi penyimpanan",

                    // Message
                    "Anda yakin akan menyimpan data karyawan ini?", 

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

    function GoEditEmployee(EmployeeID) {
        $.ajax({
            async       : false,
            headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url         : "{{ url('/EmployeeMaster/GoEditEmployee') }}",
            dataType    : "json",
            type        : "post",
            data        : {EmployeeID:EmployeeID},
            success     : function(r) {
                $("#dataProcessType").val("update");
                $("#employeeId").val(r.EmployeeID);
                $("#employeeName").val(r.EmployeeName);
                $("#employeePosition").val(r.EmployeePosition);
                $("#employeePhoneNumber").val(r.EmployeePhoneNumber);
                $("#employeeAddress").val(r.EmployeeAddress);
                $("#employeeSiteId").val(r.WorkSiteID);
                $("#btn_simpan").hide();
                $("#btn_ubah").show();
                $("#btn_reset").show();
                window.scrollTo(0, 0);
            }
        });
    }

    function GoDeleteEmployee(EmployeeID) {
        sweetConfirm("Hapus data karyawan", "Anda yakin akan menghapus data karyawan ini?", function yesCallBack(){
            document.location.href = "{{ url('/EmployeeMaster/GoDeleteEmployee') }}/" + EmployeeID;
        });
    }

    function ResetForm() {
        $("#btn_simpan").show();
        $("#btn_ubah").hide();
        $("#btn_reset").hide();
        window.scrollTo(0, 0);
    }
</script>
@endsection