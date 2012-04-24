jQuery(function($) {
	$("textearea").keyup(function(){
		if($(this).val().indexOf("<img") == -1){
			var reg=new RegExp("^<img[.^>]+/>$");
			$(this).val($(this).val().replace(reg,""));
		}
	});

	$('ul.errors').parent().css({'background-color':'#FF9696'});
	$('ul.errors').parent().find('input').focus().css({
		'border-color':'rgba(255,0,0,0.8)',
		'-webkit-box-shadow':'inset 0 1px 1px rgba(0, 0, 0, 0.075),0 0 8px rgba(255, 0, 0, 0.8)',
		'-moz-box-shadow':'inset 0 1px 1px rgba(0, 0, 0, 0.075),0 0 8px rgba(255, 0, 0, 0.8)',
		'box-shadow':'inset 0 1px 1px rgba(0, 0, 0, 0.075),0 0 8px rgba(255, 0, 0, 0.8)'
	});

	$('.alert .close').click(function(){
		$(this).parent().slideUp('slow');
		return false;
	}); 

	$('#2').click(function() {
		var noty_id = noty({"text":"Hi! I'm an example text. When I grow up I want to be a noty message.","theme":"noty_theme_mitgux","layout":"topCenter","type":"success","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":false});
	});
});