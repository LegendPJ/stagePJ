jQuery(function($) {
	tinyMCE.init({
		mode : 'textareas',
		theme : 'advanced',
		language : 'fr',
		skin : 'o2k7',
	   	skin_variant : 'silver',
		plugins : 'inlinepopups, paste, searchreplace, preview, fullscreen, table',
		theme_advanced_buttons1 : 'bold, italic, underline, strikethrough, |, bullist, numlist, |, justifyleft, justifycenter, justifyright, justifyfull, |, link, unlink, |, formatselect, fontselect,fontsizeselect, |,forecolor',
		theme_advanced_buttons2 : 'cut, copy, paste, pastetext, pasteword, |, search, replace,|,undo,redo,|,preview, fullscreen, tablecontrols',
		theme_advanced_buttons3 : '',
		theme_advanced_buttons4 : '',
		theme_advanced_toolbar_location : 'top',
		theme_advanced_toolbar_align : 'left',
		paste_remove_styles : true,
		paste_remove_spans : true,
		theme_advanced_text_colors : '#000000,#993300,#333300,#003300,#003366,#000080,#333399,#333333,#800000,#FF6600,#808000,#008000,#008080,#0000FF,#666699,#808080,#FF0000,#FF9900,#99CC00,#339966,#33CCCC,#3366FF,#800080,#999999,#FF00FF,#FFCC00,#FFFF00,#00FF00,#00FFFF,#00CCFF,#993366,#C0C0C0,#FF99CC,#FFCC99,#FFFF99,#CCFFCC,#CCFFFF,#99CCFF,#CC99FF,#FFFFFF,#235d7f,#759ebb,#FFC90E',
		paste_stip_class_attributes : 'all'});
});