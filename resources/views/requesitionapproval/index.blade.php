@extends('layout.app')

@section('content')
<header> 
    <h1 class="h3 display"><i class="fa fa-sign-in fa-lg">&nbsp;</i> Approval Pengeluaran</h1>
</header>

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h4><i class="fa fa-list">&nbsp;</i> Daftar pengajuan pengeluaran</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover table-sm datatable">
            <thead>
                <tr>
                    <th width="30px"></th>
                    <th width="30px">No.</th>
                    <th>Nama Karyawan</th>
                    <th width="150px">Tgl. Permohonan</th>
                    <th width="200px">Jumlah</th>
                    <th width="200px">Akun Kas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($unApprovedRequest as $no => $req)
                    <tr>
                        <td>
                            <button class="btn btn-primary btn-sm btn-block" onclick="goApprove('{{ Crypt::encryptString($req->RequesitionSlipID) }}');"><i class="fa fa-sign-in"></i></button>
                        </td>
                        <td>{{ ($no + 1) }}</td>
                        <td>{{ $req->EmployeeName }}</td>
                        <td>{{ \Carbon\Carbon::parse($req->RequestDate)->format('d/m/Y') }}</td>
                        <td>{{ number_format($req->Amount) }}</td>
                        <td>{{ $req->CashAccountName }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    function goApprove(requestID) {
        document.location.href = "{{ url('RequesitionApproval/GoApprove') }}/" + requestID;
    }
</script>
@endsection