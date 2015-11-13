<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- JQUERY -->
  <script type="text/javascript" src="{{ adm_assets('js/jquery.min.js') }}"></script>

  <!-- FRAMEWORK -->
  <link rel="stylesheet" media="all" href="{{ adm_assets('css/bootstrap.css') }}">

  <!-- ICON -->
  <link rel="stylesheet" media="all" href="{{ adm_assets('css/font-awesome.min.css') }}">

  <!-- PLUGINS -->
  <link rel="stylesheet" media="all" href="{{ adm_assets('plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}">
  @section('login_header')@show

  <!-- THEME STYLE -->
  <link rel="stylesheet" media="all" href="{{ adm_assets('css/style.css') }}">
  <link rel="stylesheet" media="all" href="{{ adm_assets('css/responsive.css') }}">
  <link rel="stylesheet" media="all" href="{{ adm_assets('css/shortcuts.css') }}">
  <link rel="stylesheet" media="all" href="{{ adm_assets('css/custom.css') }}">

  <style type="text/css">
    body{background: #F5F5F5;}
  </style>
  </head>
  <body>
  
    @yield('content')

    <script type="text/javascript" src="{{ adm_assets('js/bootstrap.min.js') }}"></script>
    @section('login_footer')
    @show

  </body>
</html>