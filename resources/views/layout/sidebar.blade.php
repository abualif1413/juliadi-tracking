<nav class="side-navbar">
   <div class="side-navbar-wrapper">
      <!-- Sidebar Header    -->
      <div class="sidenav-header d-flex align-items-center justify-content-center">
         <!-- User Info-->
         <div class="sidenav-header-inner text-center">
            <img src="img/avatar-7.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5">Nathan Andrews</h2>
            <span>Web Developer</span>
         </div>
         <!-- Small Brand information, appears on minimized sidebar-->
         <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
      </div>
      <!-- Sidebar Navigation Menus-->
      <div class="main-menu">
         <h5 class="sidenav-heading">APLIKASI</h5>
         <ul id="side-main-menu" class="side-menu list-unstyled">
            <li><a href=""><i class="icon-home"></i>Home</a></li>
            <li><a href=""><i class="icon-form"></i>Forms</a></li>
            <li><a href=""><i class="fa fa-bar-chart"></i>Charts</a></li>
            <li><a href=""><i class="icon-grid"></i>Tables</a></li>
            <li>
               <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
               <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
                  <li><a href="#">Page</a></li>
               </ul>
            </li>
            <li><a href="login.html"> <i class="icon-interface-windows"></i>Login page                             </a></li>
            <li>
               <a href="#">
                  <i class="icon-mail"></i>Demo
                  <div class="badge badge-warning">6 New</div>
               </a>
            </li>
         </ul>
      </div>

      <div class="main-menu">
         <h5 class="sidenav-heading">MASTER DATA</h5>
         <ul id="side-main-menu" class="side-menu list-unstyled">
            <li><a href="{!! url('/') !!}/EmployeeMaster"><i class="fa fa-users"></i>Karyawan</a></li>
            <li><a href=""><i class="fa fa-briefcase"></i>Kategori Kas</a></li>
         </ul>
      </div>
   </div>
</nav>