<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 Not Found</title>

  <!-- FRAMEWORK -->
  <link rel="stylesheet" media="all" href="{{ adm_assets('css/bootstrap.css') }}">
    
  <!-- ICON -->
  <link rel="stylesheet" media="all" href="{{ adm_assets('css/font-awesome.min.css') }}">

  <!-- PLUGINS -->

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

    <div class="error-pages">

        <img src="{{ adm_assets('img/404.png') }}" alt="404" class="icon" width="400" height="260">
        <h1>Sorry but we couldn’t find this page</h1>
        <h4>It seems that this page doesn’t exist or has been removed</h4>
        <form>
          <input type="text" class="form-control" placeholder="Search for Page">
          <i class="fa fa-search"></i>
        </form>

        <div class="bottom-links">
          <a href="index-2.html" class="btn btn-default">Go Back</a>
          <a href="index-2.html" class="btn btn-light">Go Homepage</a>
        </div>

    </div>

</body>
</html>