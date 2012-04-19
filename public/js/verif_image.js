jQuery(function($) {
	$("textearea").keyup(function(){
		if($(this).val().indexOf("<img") == -1){
			var reg=new RegExp("^<img[.^>]+/>$");
			$(this).val($(this).val().replace(reg,""));
		}
	});	
});