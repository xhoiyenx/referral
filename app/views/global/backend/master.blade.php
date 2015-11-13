<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle or '' }}</title>

    <!-- JQUERY -->
    <script type="text/javascript" src="{{ adm_assets('js/jquery.min.js') }}"></script>
    
    <!-- FRAMEWORK -->
    <link rel="stylesheet" media="all" href="{{ adm_assets('css/bootstrap.css') }}">
    
    <!-- ICON -->
    <link rel="stylesheet" media="all" href="{{ adm_assets('css/font-awesome.min.css') }}">

    <!-- PLUGINS -->
    <link rel="stylesheet" media="all" href="{{ adm_assets('plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}">
    <link rel="stylesheet" media="all" href="{{ adm_assets('plugins/select/select.min.css') }}">
    <link rel="stylesheet" media="all" href="{{ adm_assets('css/datatables.css') }}">
    
    <!-- THEME STYLE -->
    <link rel="stylesheet" media="all" href="{{ adm_assets('css/style.css') }}">
    <link rel="stylesheet" media="all" href="{{ adm_assets('css/responsive.css') }}">
    <link rel="stylesheet" media="all" href="{{ adm_assets('css/shortcuts.css') }}">
    @section('header_before_style')@show
    <link rel="stylesheet" media="all" href="{{ adm_assets('css/custom.css') }}">
    @section('header_after_style')@show

  </head>
  <body>
    <!-- Start Page Loading -->
    <div class="loading"><img src="{{ adm_assets('img/loading.gif') }}" alt="loading-img"></div>
    <!-- End Page Loading -->
    <!-- //////////////////////////////////////////////////////////////////////////// --> 
    <!-- START TOP -->
    <div id="top" class="clearfix">
      <!-- Start App Logo -->
      <div class="applogo">
        <a href="" class="logo">HONAKO</a>
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
            <li><a href="{{ route('backend.logout') }}"><i class="fa falist fa-power-off"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
      <!-- End Top Right -->
    </div>
    <!-- END TOP -->

    <!-- START SIDEBAR -->
    <div class="sidebar clearfix hidden">
      <ul class="sidebar-panel nav">
        <li class="sidetitle">MENU</li>
        <li>
          <a href="{{ adm_route('dashboard') }}"><span class="icon color5"><i class="fa fa-home"></i></span> Dashboard</a>
        </li>
        <li>
          <a href="{{ adm_route('user') }}"><span class="icon color5"><i class="fa fa-user"></i></span> Users</a>
        </li>
      </ul>
    </div>
    <!-- END SIDEBAR -->

    <!-- START CONTENT -->
    <div class="content" style="margin-left:0">

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
    
    <script type="text/javascript" src="{{ adm_assets('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ adm_assets('plugins/select/select.min.js') }}"></script>
    <script type="text/javascript" src="{{ adm_assets('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ adm_assets('js/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ adm_assets('js/datatable_init.js') }}"></script>
    <script type="text/javascript" src="{{ adm_assets('js/buttons.colVis.min.js') }}"></script>
    @section('footer')@show
    <script type="text/javascript" src="{{ adm_assets('js/plugins.js') }}"></script>
  </body>
</html>