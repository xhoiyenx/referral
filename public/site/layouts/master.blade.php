<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{ $pageTitle or $controller->getPageTitle() }}</title>
    {{ html()->style('public/site/assets/css/bootstrap.css') }}
    {{ html()->style('public/site/assets/css/flexslider.css') }}
    {{ html()->style('public/site/assets/css/style.css') }}
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                <li class="active"><a href="/" title="Home">{{ html()->image('public/site/assets/images/icoHome.png') }}</a></li>
                <li><a href="/howitworks" title="How It Works">How It Works</a></li>
                <li><a href="/whyus" title="Why us?">Why us?</a></li>
                <li><a href="/contact" title="Contact">Contact</a></li>
                <li><a href="/register" title="Register Now">Register Now</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    @yield('content')
    <footer class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">Copyright &copy; 2015 ITConcept Pte Ltd. All Rights Reserved.</footer>
    {{ html()->script('public/site/assets/js/includeScripts.js') }}
    @section('footer')
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>    
    <script type="text/javascript">stLight.options({publisher: "768569ba-d8e3-43df-a5c7-354682190c7a", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
    <script>
    var options={ "publisher": "768569ba-d8e3-43df-a5c7-354682190c7a", "logo": { "visible": true, "url": "http://www.referralsg.com", "img": "//sd.sharethis.com/disc/images/demo_logo.png", "height": 45}, "ad": { "visible": false, "openDelay": "5", "closeDelay": "0"}, "livestream": { "domain": "", "type": "sharethis", "customColors": { "widgetBackgroundColor": "#FFFFFF", "articleLinkColor": "#006fbb"}}, "ticker": { "visible": false, "domain": "", "title": "", "type": "sharethis", "customColors": { "widgetBackgroundColor": "#9d9d9d", "articleLinkColor": "#00487f"}}, "facebook": { "visible": false, "profile": "sharethis"}, "fblike": { "visible": false, "url": ""}, "twitter": { "visible": false, "user": "sharethis"}, "twfollow": { "visible": false}, "custom": [{ "visible": false, "title": "Custom 1", "url": "", "img": "", "popup": false, "popupCustom": { "width": 300, "height": 250}}, { "visible": false, "title": "Custom 2", "url": "", "img": "", "popup": false, "popupCustom": { "width": 300, "height": 250}}, { "visible": false, "title": "Custom 3", "url": "", "img": "", "popup": false, "popupCustom": { "width": 300, "height": 250}}], "chicklets": { "items": ["google_bmarks", "email", "whatsapp", "facebook", "twitter", "googleplus", "print", "google_translate"]}, "shadow": "gloss", "background": "#000000", "color": "#FFFFFF", "arrowStyle": "light"};
    var st_bar_widget = new sharethis.widgets.sharebar(options);
    </script>
    @show
  </body>
</html>