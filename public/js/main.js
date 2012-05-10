jQuery(function($) {
	//pour l'affichage des erreurs
	$('#write ul.errors').parent().css({'background-color':'#FF9696'});
	$('ul.errors').parent().find('input').addClass('erreur');
	$('ul.errors').parent().find('select').addClass('erreur');
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

	if ($('#nbenfant').val() == 'aucun' || $('#nbenfant').val() == '') {
		$('#date1-label').parent().hide();
		$('#date2-label').parent().hide();
		$('#date3-label').parent().hide();
		$('#famille p').hide();
	}
	if ($('#nbenfant').val() == '1') {
		$('#date1-label').parent().show();
		$('#date2-label').parent().hide();
		$('#date3-label').parent().hide();
		$('#famille p').hide();
	}
	if ($('#nbenfant').val() == '2') {
		$('#date1-label').parent().show();
		$('#date2-label').parent().show();
		$('#date3-label').parent().hide();
		$('#famille p').hide();
	}
	if ($('#nbenfant').val() == '3') {
		$('#date1-label').parent().show();
		$('#date2-label').parent().show();
		$('#date3-label').parent().show();
		$('#famille p').hide();
	}
	if ($('#nbenfant').val() == 'plus de 3') {
		$('#date1-label').parent().show();
		$('#date2-label').parent().show();
		$('#date3-label').parent().show();
		$('#famille p').show();
	}

	$('#nbenfant').change(function() {
		if ($(this).val() == '1') {
			$('#date1-label').parent().show();
			$('#date2-label').parent().hide();
			$('#date3-label').parent().hide();
			$('#famille p').hide();
		} else if($(this).val() == '2')  {
			$('#date1-label').parent().show();
			$('#date2-label').parent().show();
			$('#date3-label').parent().hide();
			$('#famille p').hide();
		} else if($(this).val() == '3')  {
			$('#date1-label').parent().show();
			$('#date2-label').parent().show();
			$('#date3-label').parent().show();
			$('#famille p').hide();
		} else if($(this).val() == 'aucun' || $(this).val() == '')  {
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

	//Validation enfants santé 
	$('#validSante').click(function(){
		if (($('#ident select#nbenfant').val() == '1') && ($('#famille input#date1').val() == '') ) {
			alert("Attention, vous n'avez pas saisi la date de naissance de votre premier enfant !");
		} else if (($('#ident select#nbenfant').val() == '2') && (($('#famille input#date1').val() == '') || ($('#famille input#date2').val() == ''))) {
			alert("Attention, vous n'avez pas saisi la date de naissance de votre premier ou deuxieme enfant !");
		} else if ((($('#ident select#nbenfant').val() == '3') || ($('#ident select#nbenfant').val() == 'plus de 3')) && (($('#famille input#date1').val() == '') || ($('#famille input#date2').val() == '') || ($('#famille input#date3').val() == ''))) {
			alert("Attention, vous n'avez pas saisi la date de naissance de votre premier, deuxième ou troisième enfant !");
		} else if (($('#famille select#conjoint').val() == 'Oui') && ($('#famille input#dateNC').val() == '') ) {
			alert("Attention, vous n'avez pas saisi la date de naissance de votre conjoint(e) !");
		} else { $('form').submit(); }
	});
	
	//Validation conjoint dependance
	$('#validDependance').click(function(){
		civCM = document.getElementById('civC-M').checked;
		civCMme = document.getElementById('civC-Mme').checked;
		civCMlle = document.getElementById('civC-Mlle').checked;
		if (($('#dependance select#conjoint').val() == 'Oui') && (((civCM == false) && (civCMme == false) && (civCMlle == false)) || ($('#dependance input#nomC').val() == '') || ($('#dependance input#prenomC').val() == '') || ($('#dependance input#dateC').val() == ''))) {
			alert("Attention, vous n'avez pas saisi toutes les informations de votre conjoint(e) !");
		} else { $('form').submit(); }
	});

	//Validation conjoint dependance
	$('#validEmprunt').click(function(){
		civCoM = document.getElementById('civCo-M').checked;
		civCoMme = document.getElementById('civCo-Mme').checked;
		civCoMlle = document.getElementById('civCo-Mlle').checked;
		fumeurCoO = document.getElementById('fumeurCo-Oui').checked;
		fumeurCoN = document.getElementById('fumeurCo-Non').checked;
		if (($('#emprunt select#co').val() == 'Oui') && (((civCoM == false) && (civCoMme == false) && (civCoMlle == false)) || ($('#coemprunteur input#nomCo').val() == '') || ($('#coemprunteur input#prenomCo').val() == '') || ($('#coemprunteur input#dateNCo').val() == '') || ($('#coemprunteur select#professionCo').val() == '') || ($('#coemprunteur select#quotiteCo').val() == '') || ((fumeurCoN == false) && (fumeurCoO == false))) ) {
			alert("Attention, vous n'avez pas saisi toutes les informations de votre co-emprunteur !");
		} else { $('form').submit(); }
	});

	//Accident

	if ($('#accident #contrat').val() == 'Individuel') {
		$('#familial').hide();
		$('#enfant1').hide();
		$('#enfant2').hide();
		$('#enfant3').hide();
		$('#enfant4').hide();
		$('#enfant5').hide();
	}

	$('#accident #contrat').change(function() {
		if ($(this).val() == 'Familial' && $('#nombreenfant').val() == '1') {
			$('#familial').show();
			$('#enfant1').show();
			$('#enfant2').hide();
			$('#enfant3').hide();
			$('#enfant4').hide();
			$('#enfant5').hide();
		} else if ($(this).val() == 'Familial' && $('#nombreenfant').val() == '2') {
			$('#familial').show();
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').hide();
			$('#enfant4').hide();
			$('#enfant5').hide();
		} else if ($(this).val() == 'Familial' && $('#nombreenfant').val() == '3') {
			$('#familial').show();
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').show();
			$('#enfant4').hide();
			$('#enfant5').hide();
		} else if ($(this).val() == 'Familial' && $('#nombreenfant').val() == '4') {
			$('#familial').show();
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').show();
			$('#enfant4').show();
			$('#enfant5').hide();
		} else if ($(this).val() == 'Familial' && $('#nombreenfant').val() == '5') {
			$('#familial').show();
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').show();
			$('#enfant4').show();
			$('#enfant5').show();
		} else if ($(this).val() == 'Familial' && ($('#nombreenfant').val() == 'aucun' || $('#nombreenfant').val() == '')) {
			$('#familial').show();
			$('#enfant1').hide();
			$('#enfant2').hide();
			$('#enfant3').hide();
			$('#enfant4').hide();
			$('#enfant5').hide();
		} else {
			$('#familial').hide();
			$('#enfant1').hide();
			$('#enfant2').hide();
			$('#enfant3').hide();
			$('#enfant4').hide();
			$('#enfant5').hide();
		}
	});
	if ($('#accident #contrat').val() == 'Familial') {
		if ($('#nombreenfant').val() == 'aucun' || $('#nombreenfant').val() == '') {
			$('#enfant1').hide();
			$('#enfant2').hide();
			$('#enfant3').hide();
			$('#enfant4').hide();
			$('#enfant5').hide();
		}
		if ($('#nombreenfant').val() == '1') {
			$('#enfant1').show();
			$('#enfant2').hide();
			$('#enfant3').hide();
			$('#enfant4').hide();
			$('#enfant5').hide();
		}
		if ($('#nombreenfant').val() == '2') {
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').hide();
			$('#enfant4').hide();
			$('#enfant5').hide();
		}
		if ($('#nombreenfant').val() == '3') {
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').show();
			$('#enfant4').hide();
			$('#enfant5').hide();
		}
		if ($('#nombreenfant').val() == '4') {
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').show();
			$('#enfant4').show();
			$('#enfant5').hide();
		}
		if ($('#nombreenfant').val() == '5') {
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').show();
			$('#enfant4').show();
			$('#enfant5').show();
		}
	}
	$('#nombreenfant').change(function() {
		if ($(this).val() == '1') {
			$('#enfant1').show();
			$('#enfant2').hide();
			$('#enfant3').hide();
			$('#enfant4').hide();
			$('#enfant5').hide();
		}
		if ($(this).val() == '2') {
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').hide();
			$('#enfant4').hide();
			$('#enfant5').hide();
		}
		if ($(this).val() == '3') {
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').show();
			$('#enfant4').hide();
			$('#enfant5').hide();
		}
		if ($(this).val() == '4') {
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').show();
			$('#enfant4').show();
			$('#enfant5').hide();
		}
		if ($(this).val() == '5') {
			$('#enfant1').show();
			$('#enfant2').show();
			$('#enfant3').show();
			$('#enfant4').show();
			$('#enfant5').show();
		}
		if($(this).val() == 'aucun' || $(this).val() == '')  {
			$('#enfant1').hide();
			$('#enfant2').hide();
			$('#enfant3').hide();
			$('#enfant4').hide();
			$('#enfant5').hide();
		}
	});

	//Validation enfants accident 
	$('#validAccident').click(function(){
		civCM = document.getElementById('civC-M').checked;
		civCMme = document.getElementById('civC-Mme').checked;
		civCMlle = document.getElementById('civC-Mlle').checked;
		if (($('#accident select#nombreenfant').val() == '1') && ($('#enfant1 input#nom1').val() == '' || $('#enfant1 input#prenom1').val() == '' || $('#enfant1 input#date1').val() == '') ) {
			alert("Attention, vous avez mal saisi les informations de votre premier enfant !");
		} else if (($('#accident select#nombreenfant').val() == '2') && ($('#enfant1 input#nom1').val() == '' || $('#enfant1 input#prenom1').val() == '' || $('#enfant1 input#date1').val() == '' || $('#enfant2 input#nom2').val() == '' || $('#enfant2 input#prenom2').val() == '' || $('#enfant2 input#date2').val() == '') ) {
			alert("Attention, vous avez mal saisi les informations de l'un de vos enfants !");
		} else if (($('#accident select#nombreenfant').val() == '3') && ($('#enfant1 input#nom1').val() == '' || $('#enfant1 input#prenom1').val() == '' || $('#enfant1 input#date1').val() == '' || $('#enfant2 input#nom2').val() == '' || $('#enfant2 input#prenom2').val() == '' || $('#enfant2 input#date2').val() == '' || $('#enfant3 input#nom3').val() == '' || $('#enfant3 input#prenom3').val() == '' || $('#enfant3 input#date3').val() == '') ) {
			alert("Attention, vous avez mal saisi les informations de l'un de vos enfants !");
		} else if (($('#accident select#nombreenfant').val() == '4') && ($('#enfant1 input#nom1').val() == '' || $('#enfant1 input#prenom1').val() == '' || $('#enfant1 input#date1').val() == '' || $('#enfant2 input#nom2').val() == '' || $('#enfant2 input#prenom2').val() == '' || $('#enfant2 input#date2').val() == '' || $('#enfant3 input#nom3').val() == '' || $('#enfant3 input#prenom3').val() == '' || $('#enfant3 input#date3').val() == '' || $('#enfant4 input#nom4').val() == '' || $('#enfant4 input#prenom4').val() == '' || $('#enfant4 input#date4').val() == '') ) {
			alert("Attention, vous avez mal saisi les informations de l'un de vos enfants !");
		} else if (($('#accident select#nombreenfant').val() == '5') && ($('#enfant1 input#nom1').val() == '' || $('#enfant1 input#prenom1').val() == '' || $('#enfant1 input#date1').val() == '' || $('#enfant2 input#nom2').val() == '' || $('#enfant2 input#prenom2').val() == '' || $('#enfant2 input#date2').val() == '' || $('#enfant3 input#nom3').val() == '' || $('#enfant3 input#prenom3').val() == '' || $('#enfant3 input#date3').val() == '' || $('#enfant4 input#nom4').val() == '' || $('#enfant4 input#prenom4').val() == '' || $('#enfant4 input#date4').val() == '' || $('#enfant5 input#nom5').val() == '' || $('#enfant5 input#prenom5').val() == '' || $('#enfant5 input#date5').val() == '') ) {
			alert("Attention, vous avez mal saisi les informations de l'un de vos enfants !");
		} else if (($('#accident select#conjoint').val() == 'Oui') && (((civCM == false) && (civCMme == false) && (civCMlle == false)) || ($('#accident input#nomC').val() == '') || ($('#accident input#prenomC').val() == '') || ($('#accident input#dateC').val() == ''))) {
			alert("Attention, vous n'avez pas saisi toutes les informations de votre conjoint(e) !");
		} else if ($('#accident #contrat').val() == 'Familial' && $('#accident select#nombreenfant').val() == '') {	
			alert("Attention, vous n'avez pas selectionné votre nombre d'enfant !");
		} else if ($('#accident #contrat').val() == 'Familial' && ($('#accident select#nombreenfant').val() == '' || $('#accident select#nombreenfant').val() == 'aucun') && $('#accident select#conjoint').val() == 'Non') { 
			alert("Attention, le contrat ne peut être un contrat \"Familial\" si vous n'ajoutez pas au moins un enfant ou votre conjoint(e) ! Pour souscrire un contrat seul, selectionnez \"Individuel\".");
		} else { $('form').submit(); }
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