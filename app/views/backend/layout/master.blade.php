<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle or '' }}</title>

    <!-- JQUERY -->
    {{ html()->script('public/global/jquery/jquery.min.js') }}
    
    <!-- FRAMEWORK -->
    {{ html()->style('public/global/bootstrap/bootstrap.css') }}
    
    <!-- ICON -->
    {{ html()->style('public/global/font-awesome/font-awesome.css') }}

    <!-- PLUGINS -->
    {{ html()->style('public/global/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}
    {{ html()->style('public/global/select/select.min.css') }}
    {{ html()->style('public/global/datatables/datatables.css') }} 
    
    <!-- THEME STYLE -->
    {{ html()->style('public/manager/assets/css/style.css') }}
    {{ html()->style('public/manager/assets/css/responsive.css') }}
    {{ html()->style('public/manager/assets/css/shortcuts.css') }}
    @section('header_before_style')@show
    {{ html()->style('public/manager/assets/css/custom.css') }}
    @section('header_after_style')@show

  </head>
  <body>
    <!-- Start Page Loading -->
    <div class="loading"><img src="{{ asset('public/manager/assets/img/loading.gif') }}"></div>
    <!-- End Page Loading -->
    <!-- //////////////////////////////////////////////////////////////////////////// --> 
    <!-- START TOP -->
    <div id="top" class="clearfix">
      <!-- Start App Logo -->
      <div class="applogo">
        <a href="" class="logo">ITCONCEPT</a>
      </div>
      <!-- End App Logo -->
      <!-- Start Sidebar Show Hide Button -->
      <a class="sidebar-open-button"><i class="fa fa-bars"></i></a>
      <a class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
      <!-- End Sidebar Show Hide Button -->
      <!-- Start Top Right -->
      <ul class="top-right">
        <li class="link">
          <a href="#" class="notifications">6</a>
        </li>
        <li class="dropdown link">
          <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><img src="" alt="img"><b>Hoiyen</b><span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
            <li role="presentation" class="dropdown-header">Profile</li>
            <li><a href="#"><i class="fa falist fa-inbox"></i>Inbox<span class="badge label-danger">4</span></a></li>
            <li><a href="#"><i class="fa falist fa-file-o"></i>Files</a></li>
            <li><a href="#"><i class="fa falist fa-wrench"></i>Settings</a></li>
            <li class="divider"></li>
            <li><a href="#"><i class="fa falist fa-lock"></i> Lockscreen</a></li>
            <li><a href="{{ $logout_url }}"><i class="fa falist fa-power-off"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
      <!-- End Top Right -->
    </div>
    <!-- END TOP -->

    <!-- START SIDEBAR -->
    <!-- <div class="sidebar clearfix hidden"> SET DEFAULT HIDDEN -->
    <div class="sidebar clearfix">
      @include('layout.menu')
    </div>
    <!-- END SIDEBAR -->

    <!-- START CONTENT -->
    <!-- <div class="content" style="margin-left:0"> SET DEFAULT HIDDEN -->
    <div class="content">
      @yield('content')
    
      <!-- Start Footer -->
      <div class="row footer">
        <div class="col-md-6 text-left">
        </div>
        <div class="col-md-6 text-right">
        </div>
      </div>
      <!-- End Footer -->
    </div>
    <!-- End Content -->
    {{ html()->script('public/global/bootstrap/bootstrap.min.js') }}
    {{ html()->script('public/global/select/select.min.js') }}
    {{ html()->script('public/global/datatables/jquery.dataTables.min.js') }}
    {{ html()->script('public/global/datatables/dataTables.buttons.min.js') }}
    {{ html()->script('public/global/datatables/datatable_init.js') }}
    {{ html()->script('public/global/datatables/buttons.colVis.min.js') }}
    @section('footer')@show
    {{ html()->script('public/manager/assets/js/plugins.js') }}
  </body>
</html>