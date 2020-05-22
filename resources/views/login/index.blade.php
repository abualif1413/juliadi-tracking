<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tracking dan Reinburst</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="{{ url('node_modules/sweetalert2/dist/sweetalert2.min.css') }}">
    <!-- Custom Bootstrap Toggle -->
    <link rel="stylesheet" href="{!! url('/') !!}/web-template/css/bootstrap-toggle.min.css">
  </head>
  <body>
  <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span>TRACKING </span><strong class="text-primary">REINBURST</strong></div>
            <form method="post" action="{{ url('/Login/LoginAttemp') }}" class="text-left form-validate" autocomplete="off">
              @csrf()
              <div class="form-group-material">
                <input id="login-username" type="text" name="loginUsername" required data-msg="Please enter your username" class="input-material" autocomplete="nope">
                <label for="login-username" class="label-material">Username</label>
              </div>
              <div class="form-group-material">
                <input id="login-password" type="password" name="loginPassword" required data-msg="Please enter your password" class="input-material" autocomplete="new-password">
                <label for="login-password" class="label-material">Password</label>
              </div>
              <div class="form-group text-center">
                  <button class="btn btn-primary"><i class="fa fa-key">&nbsp;</i> Login Aplikasi</button>
              </div>
            </form>
          </div>
          <div class="copyrights text-center">
            <p>Design by <a href="https://bootstrapious.com/p/bootstrap-4-dashboard" class="external">Bootstrapious</a></p>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
          </div>
        </div>
      </div>
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
    <script src="{{ url('node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('node_modules/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ url('node_modules/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ url('web-template/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ url('web-template/js/custom.js') }}"></script>
    <!-- Main File-->
    <script src="{!! url('/') !!}/web-template/js/front.js"></script>
  </body>
</html>