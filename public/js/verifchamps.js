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
	$('#validModif').click(function(){
		if ($.trim($('#ajouter input#titre').val()) == "") {
			noty({"text":"Attention ! Vous devez au moins remplir le titre !","theme":"noty_theme_mitgux","layout":"topCenter","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":100000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":true});
		} else {
			$('form').submit();
			noty({"text":"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chargement en cours...","layout":"center","type":"alert","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":100000,"closeButton":false,"closeOnSelfClick":false,"closeOnSelfOver":false,"modal":true});
		}
	});

	//Bouton pour editer l'encadre
	$('#validEdit').click(function(){
		if ($.trim($('#editer input#titre').val()) == "") {
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
		}
		else if(titre != '') {
			$(this).css({'border':'1px solid #CCC','background-color':'white'}).removeClass('erreur');
			$(this).parent().find('p.vChamp').remove();
		}
	});

	$('#editer input#titre').change(function(){
		var titre = $(this).val();
		if(titre == '') {
			$(this).css({'border':'1px solid red', 'background-color':'#FF9696'}).addClass('erreur');
			$(this).parent().find('p.vChamp').remove();
			$(this).after('<p class="vChamp">Attention, le titre est vide !</p>');
		}
		else if(titre != '') {
			$(this).css({'border':'1px solid #CCC','background-color':'white'}).removeClass('erreur');
			$(this).parent().find('p.vChamp').remove();
		}
	});


	$("#sortable").sortable().disableSelection();
		$('#ordreModal input:submit').click(function(){
			var result = $('#sortable').sortable('toArray');
			for (var i in result){
				$('#ordreModal li#'+result[i]+' input').val(result[i]+'-'+i);
			}
		$('form').submit();
	});

	$('#ajoutNews').click(function(){
		if ($.trim($('#ajouter input#titre').val()) == "") {
			noty({"text":"Attention ! Vous devez remplir le champ du titre !","theme":"noty_theme_mitgux","layout":"topCenter","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":100000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":true});
		} else if ($.trim($('#ajouter input#lien').val()) == "") {
			noty({"text":"Attention ! Vous devez remplir le champ du lien !","theme":"noty_theme_mitgux","layout":"topCenter","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":100000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":true});
		} else {
			$('form').submit();
			noty({"text":"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chargement en cours...","layout":"center","type":"alert","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":100000,"closeButton":false,"closeOnSelfClick":false,"closeOnSelfOver":false,"modal":true});
		}
	});

	$('#editNews').click(function(){
		if ($.trim($('#editer input#titre').val()) == "") {
			noty({"text":"Attention ! Vous devez remplir le champ du titre !","theme":"noty_theme_mitgux","layout":"topCenter","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":100000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":true});
		} else if ($.trim($('#editer input#lien').val()) == "") {
			noty({"text":"Attention ! Vous devez remplir le champ du lien !","theme":"noty_theme_mitgux","layout":"topCenter","type":"error","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":100000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":true});
		} else {
			$('form').submit();
			noty({"text":"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Chargement en cours...","layout":"center","type":"alert","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":100000,"closeButton":false,"closeOnSelfClick":false,"closeOnSelfOver":false,"modal":true});
		}
	});
});