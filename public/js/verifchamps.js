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

	$('input:submit').click(function(){
		$('input:text').removeClass('erreur');
		$('input:text+ul').remove();
		if($.trim($('input:text').val()) == '') {
			$('input:text').addClass('erreur').parent().append('<ul class="errors"><li>Ce champ ne peut être vide</li></ul>');
			return false;
		}
	});

	$('.modal').on('hidden', function () {
		$('input:text').removeClass('erreur');
		$('input:text+ul').remove();
	});
});