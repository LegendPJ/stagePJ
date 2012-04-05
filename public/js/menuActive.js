jQuery(function($) {
	$('.navMenu a').click(function(){
		$('.navMenu a').removeClass('current');
		$(this).addClass('current');
	}); 
});
