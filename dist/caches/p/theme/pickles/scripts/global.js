$(window).load(function(){
	function windowResize(){
		if( !$('body.top').size() ){
			$('.theme_mainblock').css({'margin-top': $('header.theme_header').outerHeight()});
		}
	}
	$(window).resize(windowResize);
	windowResize();
});
