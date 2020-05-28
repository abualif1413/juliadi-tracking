<nav class="side-navbar">
   <div class="side-navbar-wrapper">
      <!-- Sidebar Header    -->
      <div class="sidenav-header d-flex align-items-center justify-content-center">
         <!-- User Info-->
         <div class="sidenav-header-inner text-center">
            @if(session('EmployeeID') == 'root')
               <i class="fa fa-floppy-o fa-lg" style="font-size: 200%;"></i>
            @else
               <i class="fa fa-users fa-lg" style="font-size: 200%;"></i>
            @endif
            <h2 class="h5">{{ session('EmployeeName') }}</h2>
            <span>{{ session('EmployeePosition') }}</span>
         </div>
         <!-- Small Brand information, appears on minimized sidebar-->
         <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>T</strong><strong class="text-primary">R</strong></a></div>
      </div>
      <!-- Sidebar Navigation Menus-->
      <div class="main-menu">
         <h5 class="sidenav-heading">APPS</h5>
         @if(session('AccountRole') == 1)
            <ul id="side-main-menu" class="side-menu list-unstyled">
               <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>Home</a></li>
               <li><a href="{{ url('/CashTopUp') }}"><i class="fa fa-mail-reply"></i>Tambah Saldo</a></li>
               <li><a href="{{ url('/RequesitionSlip') }}"><i class="fa fa-mail-forward"></i>Pengeluaran</a></li>
               <li><a href="{{ url('/RequesitionApproval') }}"><i class="fa fa-sign-in"></i>Approval Pengeluaran</a></li>
               <li><a href="#laporan" aria-expanded="false" data-toggle="collapse"><i class="fa fa-list-ul"></i>Laporan</a>
               <ul id="laporan" class="collapse list-unstyled ">
                  <li><a href="#"><i class="fa fa-book"></i>Buku kas</a></li>
               </ul>
               </li>
            </ul>
         @elseif(session('AccountRole') == 2)
            <ul id="side-main-menu" class="side-menu list-unstyled">
               <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>Home</a></li>
               <li><a href="{{ url('/RequesitionSlip') }}"><i class="fa fa-mail-forward"></i>Pengeluaran</a></li>
            </ul>
         @endif
      </div>

      @if(session('AccountRole') == 1)
         <div class="main-menu">
            <h5 class="sidenav-heading">MASTER DATA</h5>
            <ul id="side-main-menu" class="side-menu list-unstyled">
               <li><a href="{!! url('/') !!}/EmployeeMaster"><i class="fa fa-users"></i>Karyawan</a></li>
               <li><a href="{{ url('/CashAccountMaster') }}"><i class="fa fa-briefcase"></i>Kategori Kas</a></li>
               <li><a href="{{ url('/UserMaster') }}"><i class="fa fa-address-book"></i>Buat Akun</a></li>
            </ul>
         </div>
      @endif
   </div>
</nav>