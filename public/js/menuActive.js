jQuery(function($) {
	$('.navMenu a').click(function(){
		$('.navMenu a.current').removeClass('current');
		$(this).addClass('current');
	}); 
});
