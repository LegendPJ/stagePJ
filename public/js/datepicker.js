jQuery(function($) {
$(".datepicker").datepicker({	
		dateFormat: 'dd/mm/yy',
		defaultDate: '01/01/1950',
		dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],			
		dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
		monthNamesShort: ['Jan','Fev','Mar','Avr','Mai','Jun','Jul','Août','Sep','Oct','Nov','Déc'],
		monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		changeYear: true,
		changeMonth: true,
		yearRange: '-70y:-1y',
		firstDay: 1,
		prevText: 'Précédent',
		nextText: 'Suivant'
	});
});