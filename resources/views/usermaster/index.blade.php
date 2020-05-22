@extends('layout.app')

@section('content')

<header> 
    <h1 class="h3 display"><i class="fa fa-address-book-o fa-lg">&nbsp;</i> Data Akun Pengguna Karyawan</h1>
</header>

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h4><i class="fa fa-list">&nbsp;</i> Daftar Karyawan</h4>
    </div>
    <div class="card-body">
         <table class="table table-striped table-hover table-sm datatable">
            <thead>
                <tr>
                    <th width="120px"></th>
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
                            @if($employee->EmployeeIDAccount != "" && $employee->Active == "y")
                                <input type="checkbox" checked data-toggle="toggle"
                                            data-on="Active" data-off="Not Active"
                                            data-width="120" data-height="25"
                                            data-onstyle="primary" data-offstyle="default"
                                            onchange="GoSwitchUserStatus('{{ Crypt::encryptString($employee->EmployeeID) }}');" />
                            @elseif($employee->EmployeeIDAccount != "" && $employee->Active == "n")
                                <input type="checkbox" data-toggle="toggle"
                                        data-on="Active" data-off="Not Active"
                                        data-width="120" data-height="25"
                                        data-onstyle="primary" data-offstyle="default"
                                        onchange="GoSwitchUserStatus('{{ Crypt::encryptString($employee->EmployeeID) }}');" />
                            @else

                            @endif
                        </td>
                        <td>
                            @if($employee->EmployeeIDAccount != "")
                                <button class="btn btn-warning btn-sm btn-block" onclick="GoManageUser('{{ Crypt::encryptString($employee->EmployeeID) }}');"><i class="fa fa-check"></i></button>
                            @else
                                <button class="btn btn-primary btn-sm btn-block" onclick="GoCreateUser('{{ Crypt::encryptString($employee->EmployeeID) }}', '{{ $employee->EmployeeName }}');"><i class="fa fa-unlock-alt"></i></button>
                            @endif
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
    function GoCreateUser(employeeId, employeeName) {
        sweetConfirm("Buat akun karyawan", "Anda yakin akan membuat akun pengguna untuk<br /><b>" + employeeName + "</b>?", function() {
            document.location.href = "{{ url('/UserMaster/CreateUser') }}/" + employeeId;
        });
    }

    function GoManageUser(employeeId) {
        document.location.href = "{{ url('/UserMaster/ManageUser') }}/" + employeeId;
    }

    function GoSwitchUserStatus(EmployeeID) {
        $.ajax({
            async       : false,
            headers     : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url         : "{{ url('/UserMaster/SwitchUserStatus') }}",
            dataType    : "text",
            type        : "post",
            data        : {EmployeeID:EmployeeID},
            success     : function(r) {
                sweetAlert("Perhatian", r);
            }
        });
    }
</script>
@endsection