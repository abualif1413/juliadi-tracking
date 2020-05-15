<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tracking dan Reinburst</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{!! url('/') !!}/web-template/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{!! url('/') !!}/web-template/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{!! url('/') !!}/web-template/css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{!! url('/') !!}/web-template/css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="{!! url('/') !!}/web-template/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{!! url('/') !!}/web-template/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{!! url('/') !!}/web-template/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{!! url('/') !!}/web-template/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ url('datatables/datatables.min.css') }}">
  </head>
  <body>
    <!-- Side Navbar -->
    @include('layout.sidebar')
    <div class="page">
      <!-- navbar-->
      @include('layout.navbar')
      <!-- Updates Section -->
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
            @yield('content')
        </div>
      </section>
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Tracking &amp; Reinburst &copy; 2020</p>
            </div>
            <div class="col-sm-6 text-right">
              <p>Design by <a href="https://bootstrapious.com/p/bootstrap-4-dashboard" class="external">Bootstrapious</a></p>
              <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions and it helps me to run Bootstrapious. Thank you for understanding :)-->
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- JavaScript files-->
    <script src="{!! url('/') !!}/web-template/vendor/jquery/jquery.min.js"></script>
    <script src="{!! url('/') !!}/web-template/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="{!! url('/') !!}/web-template/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{!! url('/') !!}/web-template/js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="{!! url('/') !!}/web-template/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="{!! url('/') !!}/web-template/vendor/chart.js/Chart.min.js"></script>
    <script src="{!! url('/') !!}/web-template/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="{!! url('/') !!}/web-template/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{ url('datatables/datatables.min.js') }}"></script>
    <script>
      $(function() {
        $("table.datatable").DataTable();
      });
    </script>
    <!-- Main File-->
    <script src="{!! url('/') !!}/web-template/js/front.js"></script>
  </body>
</html>