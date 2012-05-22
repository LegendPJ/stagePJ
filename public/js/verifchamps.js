jQuery(function($) {
	$('a#edit').click(function(){
		var id = $(this).data('id');
		var titre = $(this).data('titre');
		$('#myModal input:text').val(titre);
		$('#myModal input[type="hidden"]').val(id);
	});

	$('a#delete').click(function(){
		var idSup = $(this).data('id');
		$('#deleteModal input[type="hidden"]').val(idSup);
	});

	$('#myModal input:submit').click(function(){
		$('#myModal input:text').removeClass('erreur');
		$('#myModal input:text+ul').remove();
		if($.trim($('#myModal input:text').val()) == '') {
			$('#myModal input:text').addClass('erreur').parent().append('<ul class="errors"><li>Ce champ ne peut être vide</li></ul>');
			return false;
		}
	});
	//Boite Modale Partie Admin
	$('.modal').on('hidden', function () {
		$('input:text').removeClass('erreur');
		$('input:text+ul').remove();
	});
	//Bouton Ajouter le Grand Titre
	var titreok = true;
	$('#validModif').click(function(){
		if ($.trim($('#ajouter input#titre').val()) == "") {
			titreok = false;
			noty({"text":"Attention ! Vous devez au moins remplir le titre !","theme":"noty_theme_mitgux","layout":"topCenter","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":100000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":true});
		} else {
			$('form').submit();
			noty({"text":"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chargement en cours...","layout":"center","type":"alert","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":100000,"closeButton":false,"closeOnSelfClick":false,"closeOnSelfOver":false,"modal":true});
		}
	});

	$('#ajouter input#titre').change(function(){
		var titre = $(this).val();
		if(titre == '') {
			$(this).css({'border':'1px solid red', 'background-color':'#FF9696'}).addClass('erreur');
			$(this).parent().find('p.vChamp').remove();
			$(this).after('<p class="vChamp">Attention, le titre est vide !</p>');
			titreok = false;
		}
		else if(titre != '') {
			$(this).css({'border':'1px solid #CCC','background-color':'white'}).removeClass('erreur');
			$(this).parent().find('p.vChamp').remove();
			titreok = true;
		}
	});
});