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
		$('#coemprunteur th label').attr('class', 'optional');
	}
	if ($('#co').val() == 'Oui') {
		$('#coemprunteur').show();
		$('#emprunteur').css({'margin-left':'30px', 'float':'left'});
		$('#coemprunteur th label').attr('class', 'required');
	}
	$('#co').change(function() {
		if ($(this).val() == 'Oui') {
			$('#coemprunteur').show();
			$('#coemprunteur th label').attr('class', 'required');
			// $('#emprunteur').hide('slide', { direction: 'left' }, 1000);
			$('#emprunteur').css({'margin-left':'30px', 'float':'left'});
		} else {
			$('#coemprunteur').hide();
			$('#coemprunteur th label').attr('class', 'optional');
			$('#emprunteur').css({'margin-left':'200px', 'float':'none'});
			// $('#emprunteur').show('slide', { direction: 'right' }, 1000);
		}
	});
	//Q
		// $('.QapTcha').QapTcha(); 
		// $('.QapTcha').QapTcha({autoRevert : true, PHPfile : 'c:/wamp/www/Xylagroup/public/js/Qaptcha.jquery.php' }); 
	// $('#deux').hide();
	// $('#trois').hide();
	// $('#quatre').hide();
	// $('#un a').click(function(){
	// 	$('form').submit();
	// 	$('#un').hide();
	// 	$('#deux').show();
	// });
	// $('#deux a').click(function(){
	// 	$('#deux').hide();
	// 	$('#trois').show();
	// 	$('#un').hide();
	// 	$('#quatre').hide();
	// });
	// $('#trois a').click(function(){
	// 	$('#trois').hide();
	// 	$('#quatre').show();
	// 	$('#un').hide();
	// 	$('#eux').hide();
	// });
	//Devis Santé
	if ($('#nbenfant').val() == 'aucun') {
			$('#date1-label').parent().hide();
			$('#date2-label').parent().hide();
			$('#date3-label').parent().hide();
			$('#famille p').hide();
	}
	$('#nbenfant').change(function() {
		if ($(this).val() == '1') {
			$('#date1-label').parent().show();
			$('#date2-label').parent().hide();
			$('#date3-label').parent().hide();
		} else if($(this).val() == '2')  {
			$('#date1-label').parent().show();
			$('#date2-label').parent().show();
			$('#date3-label').parent().hide();
		} else if($(this).val() == '3')  {
			$('#date1-label').parent().show();
			$('#date2-label').parent().show();
			$('#date3-label').parent().show();
		} else if($(this).val() == 'aucun')  {
			$('#date1-label').parent().hide();
			$('#date2-label').parent().hide();
			$('#date3-label').parent().hide();
			$('#famille p').hide();
		} else if($(this).val() == 'plus de 3')  {
			$('#date1-label').parent().show();
			$('#date2-label').parent().show();
			$('#date3-label').parent().show();
			$('#famille p').show();
		}
	});
	if ($('#famille #conjoint').val() == 'Non') {
		$('#dateNC-label').parent().hide();
	}
	$('#famille #conjoint').change(function() {
		if ($(this).val() == 'Oui') { $('#dateNC-label').parent().show(); } 
		else { $('#dateNC-label').parent().hide(); }
	});
	//Pour noty
	$(function(){
		if($('ul.errors').length > 0) {
			noty({"text":"Attention ! Le formulaire comporte une ou plusieurs erreurs !","theme":"noty_theme_mitgux","layout":"center","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":4000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":true,"modal":true});
		}
	});
	//validation formulaires
	$('#Validation').click(function(){ 
		$('form').submit(); 
	});
	//POUR WEBKIT
	$('label[for^="civ-"]').parent().find('ul').addClass('webkiit');
	$('label[for^="q1-"]').parent().find('ul').addClass('webkiit');
	$('label[for^="q2-"]').parent().find('ul').addClass('webkiit');
	$('label[for^="q3-"]').parent().find('ul').addClass('webkiit');
	$('label[for^="fumeur-"]').parent().find('ul').addClass('webkiit');
	$('label[for^="IPT-"]').parent().find('ul').addClass('webkiit');
	$('label[for^="IPP-"]').parent().find('ul').addClass('webkiit');
});