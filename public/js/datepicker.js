jQuery(function($) {
$.datepicker.setDefaults($.datepicker.regional['fr']);
			$("#datepicker").datepicker({
				dateFormat: 'dd-mm-yy',
				changeYear: true
			});
});