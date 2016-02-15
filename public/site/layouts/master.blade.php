<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{ $pageTitle or $controller->getPageTitle() }}</title>
    @if ( $meta_desc != '' )
    <meta name="description" content="{{ $meta_desc }}" />
    @endif
    @if ( $meta_key != '' )
    <meta name="keywords" content="{{ $meta_key }}" />
    @endif
    {{ html()->style('public/site/assets/css/bootstrap.css') }}
    {{ html()->style('public/site/assets/css/flexslider.css') }}
    {{ html()->style('public/site/assets/css/style.css') }}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="//assets.upshare.co/widget-b/widget.css" type="text/css" media="all" />
  </head>
  <body>
    <header>
      <nav class="navbar mainMenu">
        <div class="container">
          <div class="row">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              <a class="navbar-brand" href="/">{{ html()->image('public/site/assets/images/logo.png') }}</a>
            </div>
            <div class="collapse navbar-collapse navbar-right" id="mainNav">
              <ul class="nav navbar-nav text-uppercase">
                <li @if ( request()->path() == "/" ) class="active"@endif><a href="/" title="Home">{{ html()->image('public/site/assets/images/icoHome.png') }}</a></li>
                <li @if ( request()->path() == "howitworks" ) class="active"@endif><a href="/howitworks" title="How It Works">How It Works</a></li>
                <li @if ( request()->path() == "whyus" ) class="active"@endif><a href="/whyus" title="Why us?">Why us?</a></li>
                <li @if ( request()->path() == "register" ) class="active"@endif><a href="/register" title="Register Now">Register Now</a></li>
                <li @if ( request()->path() == "contact" ) class="active"@endif><a href="/contact" title="Contact">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    @yield('content')
    <footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">{{ settings('footer') }}</footer>
    {{ html()->script('public/site/assets/js/includeScripts.js') }}
    <div id="up-branding">Viral <a target="_blank" href="http://www.upshare.co/buttons/">Buttons</a> by UP</div>
    <script src="//widget.upshare.co/up-load.js?signupArrow=true" id="UPWidget"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/566846d85744aabc46536c14/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
      })();      
    </script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-71428333-1', 'auto');
      ga('send', 'pageview');
    </script>    
    @section('footer')
    @show
  </body>
</html>