@extends('layout.app')

@section('content')

<header> 
    <h1 class="h3 display"><i class="fa fa-users fa-lg">&nbsp;</i> Data Karyawan</h1>
</header>

<form method="post" action="{!! url('/') !!}/EmployeeMaster/AddEmployee">
    @csrf
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4><i class="fa fa-file">&nbsp;</i> Form data karyawan</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input type="text" name="employeeName" id="employeeName" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" name="employeePosition" id="employeePosition" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="employeePhoneNumber" id="employeePhoneNumber" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="employeeAddress" id="employeeAddress" class="form-control" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Unit kerja</label>
                        <div class="input-group">
                            <select name="employeeSiteId" id="employeeSiteId" class="form-control">
                                <option value=""></option>
                                @foreach($workSites as $sites)
                                    <option value="{{ $sites->WorkSiteID }}">{{ $sites->WorkSiteName }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="card-footer">
            <button class="btn btn-primary"><i class="fa fa-save">&nbsp;</i> Simpan</button>
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