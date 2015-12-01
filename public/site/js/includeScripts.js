include('jquery.min.js');  // Include jQuery Library
include('modernizr.full.min.js');  
include('bootstrap.js');  // Include bootstrap library
include('jquery.flexslider.js');  // Include flexslider library
include('jquery.placeholder.js');  // Include placeholder library
include('app.js');  // Include Custom Function
//----Include-Function----
function include(url){
  document.write('<script type="text/javascript" src="js/' + url + '"></script>'); // Print js files on page
  return false ;
}