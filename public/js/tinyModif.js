jQuery(function($) {
	tinyMCE.init({
		mode : 'textareas',
		theme : 'advanced',
		language : 'fr',
		skin : 'o2k7',
	   		skin_variant : 'silver',
		plugins : 'inlinepopups, paste',
		theme_advanced_buttons1 : 'bold, italic, underline, |, bullist, numlist, |, justifyleft, justifyright, justifycenter, justifyfull, |, link, unlink, |, formatselect, fontselect,fontsizeselect, |,forecolor',
		theme_advanced_buttons2 : '',
		theme_advanced_buttons3 : '',
		theme_advanced_buttons4 : '',
		theme_advanced_toolbar_location : 'top',
		theme_advanced_toolbar_align : 'left',
		paste_remove_styles : true,
		paste_remove_spans : true,
		paste_stip_class_attributes : 'all'});
});