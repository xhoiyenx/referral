$(function(){
/*	$("html").niceScroll({
		styler:"fb",
		cursorcolor:"#000",
		cursorborder:"none",
		cursorwidth:"8px",
		zindex:"9999"
	});
*/
/********** logo fading function **********/
    $(".navbar-brand img").fadeTo("slow", 1);
    $(".navbar-brand img").hover(function(){
    $(this).fadeTo("medium", 0.5); // This should set the opacity to 80% on hover
    },function(){
	$(this).fadeTo("slow", 1); // This should set the opacity back to 50% on mouseout
    });	
	
	$('.flexslider').flexslider({
		controlNav: false,
		directionNav: false,	
	});
	
	$('[data-toggle="tooltip"]').tooltip();
	
	$('input, textarea').placeholder();
})