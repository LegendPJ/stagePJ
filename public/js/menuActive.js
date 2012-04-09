jQuery(function($) {
	console.log("debut fonction");
	$('ul.navMenu a').click(function(){
		console.log("juste avant la detection");
		$('ul.navMenu a.current').removeClass('current');
		console.log("on remove la classe");
		$(this).addClass('current');
		console.log("on add la classé");
	}); 
	console.log("fin de la fonction");
});
