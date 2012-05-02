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

	//pour le conjoitn dans le formulaire de dépendance
	if ($('#conjoint').val() == 'Non') {
			$('#civC-label').parent().hide();

			$('#nomC-label').parent().hide();

			$('#prenomC-label').parent().hide();

			$('#dateNC-label').parent().hide();
	}

	$('#conjoint').change(function() {
		if ($(this).val() == 'Oui') {
			$('#civC-label').parent().slideDown();

			$('#nomC-label').parent().slideDown();

			$('#prenomC-label').parent().slideDown();

			$('#dateNC-label').parent().slideDown();
		} else {
			$('#civC-label').parent().slideUp();

			$('#nomC-label').parent().slideUp();

			$('#prenomC-label').parent().slideUp();

			$('#dateNC-label').parent().slideUp();
		}
	}); 
});