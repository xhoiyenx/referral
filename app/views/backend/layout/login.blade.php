<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title or '' }}</title>

  <!-- JQUERY -->
  {{ html()->script('public/global/jquery/jquery.min.js') }}

  <!-- FRAMEWORK -->
  {{ html()->style('public/global/bootstrap/bootstrap.css') }}

  <!-- ICON -->
  {{ html()->style('public/global/font-awesome/font-awesome.css') }}

  <!-- PLUGINS -->
  {{ html()->style('public/global/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}
  @section('login_header')@show

  <!-- THEME STYLE -->
  {{ html()->style('public/manager/assets/css/style.css') }}
  {{ html()->style('public/manager/assets/css/responsive.css') }}
  {{ html()->style('public/manager/assets/css/shortcuts.css') }}
  {{ html()->style('public/manager/assets/css/custom.css') }}

  <style type="text/css">
    body{background: #F5F5F5;}
  </style>
  </head>
  <body>
  
  @yield('content')
  {{ html()->script('public/global/bootstrap/bootstrap.min.js') }}
  @section('login_footer')
  @show

  </body>
</html>