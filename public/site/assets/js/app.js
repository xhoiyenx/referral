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

	var menuClass = '.mainMenu';
		//var top = $(menuClass).offset().top - parseFloat($(menuClass).css('marginTop').replace(/auto/, 0));
		var top = $(menuClass).offset().top - parseFloat($(menuClass).css('marginTop').replace(/auto/, 0)) + 100;
		setMenuTop(menuClass, top);
		$(window).scroll(function (event) {
			setMenuTop(menuClass, top);
		});
		
	function setMenuTop(menuSelector, top){
		var y = $(window).scrollTop();
		if (y >= top) {
			$(menuSelector).addClass('fixed');
		} else {
			$(menuSelector).removeClass('fixed');
		}
	}		

	$('.homeBanner > .container').prepend('<h1 class="text-uppercase text-right txtMobile">' + $(".txtDesktop").html() + '</h1>');
	
})