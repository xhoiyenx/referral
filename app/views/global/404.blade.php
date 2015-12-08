<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 Not Found</title>

  <!-- FRAMEWORK -->
  {{ html()->style('public/global/bootstrap/bootstrap.css') }}
    
  <!-- ICON -->
  {{ html()->style('public/global/font-awesome/font-awesome.css') }}

  <!-- PLUGINS -->

  <!-- THEME STYLE -->
  {{ html()->style('public/manager/assets/css/style.css') }}
  {{ html()->style('public/manager/assets/css/responsive.css') }}
  {{ html()->style('public/manager/assets/css/shortcuts.css') }}
  @section('header_before_style')@show
  {{ html()->style('public/manager/assets/css/custom.css') }}
  @section('header_after_style')@show

  <style type="text/css">
    body{background: #F5F5F5;}
  </style>
  </head>
  <body>

    <div class="error-pages">

        <img src="/public/manager/assets/img/404.png" alt="404" class="icon" width="400" height="260">
        <h1>Sorry but we couldn’t find this page</h1>
        <h4>It seems that this page doesn’t exist or has been removed</h4>
        <!--
        <form>
          <input type="text" class="form-control" placeholder="Search for Page">
          <i class="fa fa-search"></i>
        </form>

        
        <div class="bottom-links">
          <a href="index-2.html" class="btn btn-default">Go Back</a>
          <a href="index-2.html" class="btn btn-light">Go Homepage</a>
        </div>
        -->

    </div>

</body>
</html>