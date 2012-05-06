jQuery(function($) {

	//pour l'affichage des erreurs
	$('#write ul.errors').parent().css({'background-color':'#FF9696'});
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

	//pour le conjoint dans le formulaire de dépendance
	if ($('#conjoint').val() == 'Non') {
			$('#civC-label').parent().hide();

			$('#nomC-label').parent().hide();

			$('#prenomC-label').parent().hide();

			$('#dateC-label').parent().hide();
	}

	$('#conjoint').change(function() {
		if ($(this).val() == 'Oui') {
			$('#civC-label').parent().slideDown();

			$('#nomC-label').parent().slideDown();

			$('#prenomC-label').parent().slideDown();

			$('#dateC-label').parent().slideDown();
		} else {
			$('#civC-label').parent().slideUp();

			$('#nomC-label').parent().slideUp();

			$('#prenomC-label').parent().slideUp();

			$('#dateC-label').parent().slideUp();
		}
	});

	//tooltip
	$('#scroll a').tooltip();

	//pour le co-emprunteur
	if ($('#co').val() == 'Non') {
		$('#coemprunteur').hide();
	}
	if ($('#co').val() == 'Oui') {
		$('#coemprunteur').show();
		$('#emprunteur').css({'margin-left':'30px', 'float':'left'});
	}

	$('#co').change(function() {
		if ($(this).val() == 'Oui') {
			$('#coemprunteur').show();
			// $('#emprunteur').hide('slide', { direction: 'left' }, 1000);
			$('#emprunteur').css({'margin-left':'30px', 'float':'left'});
		} else {
			$('#coemprunteur').hide();
			$('#emprunteur').css({'margin-left':'200px', 'float':'none'});
			// $('#emprunteur').show('slide', { direction: 'right' }, 1000);
		}
	});

	//Q
		// $('.QapTcha').QapTcha(); 
		// $('.QapTcha').QapTcha({autoRevert : true, PHPfile : 'c:/wamp/www/Xylagroup/public/js/Qaptcha.jquery.php' }); 
	$('#deux').hide();
	$('#trois').hide();
	$('#quatre').hide();

	$('#un a').click(function(){
		$('#un').hide();
		$('#deux').show();
		$('#trois').hide();
		$('#quatre').hide();
	});

	$('#deux a').click(function(){
		$('#deux').hide();
		$('#trois').show();
		$('#un').hide();
		$('#quatre').hide();

	});
	$('#trois a').click(function(){
		$('#trois').hide();
		$('#quatre').show();
		$('#un').hide();
		$('#eux').hide();
	});

	//Pour noty
	$(function(){
		if($('ul.errors').length > 0) {
			noty({"text":"Attention, il y a des erreurs dans le formulaire !","theme":"noty_theme_mitgux","layout":"top","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":4000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":true,"modal":true});
		}
	});

	//validation formulaires
	$('#Validation').click(function(){ 
		$('form').submit(); 
	});
});