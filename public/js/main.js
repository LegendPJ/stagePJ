jQuery(function($) {
	//pour l'affichage des erreurs
	$('ul.errors').parent().css({'background-color':'#FF9696'});
	$('ul.errors').parent().find('input').addClass('erreur');
	//pour fermer le flash messenger
	$('.alert .close').click(function(){
		$(this).parent().slideUp('slow');
		return false;
	}); 
	//pour le scrollTop
	$('#scroll').hide();

	$(function(){
		$(window).scroll(function(){
			if ($(this).scrollTop() > 200){
				 $('#scroll').fadeIn();
			}else{
				 $('#scroll').fadeOut();
			}
		});
	});

	 $('#scroll a').click(function(){
			$('body,html').animate({
				 scrollTop: 0
			}, 300);
			return false;
	 });
});