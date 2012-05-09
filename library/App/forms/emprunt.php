<?php 
class App_forms_emprunt extends Zend_Form 
{
	public function __construct() {

		$decorators =  array('ViewHelper', 'Errors',
				array('Description', array('tag' => 'p', 'class' => 'description')),
				array('HtmlTag', array('tag' => 'td')),
				array('Label', array('tag' => 'th')),
				array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
				);
		
		//DEBUT PROJET
		$this->montant = new Zend_Form_Element_Text('montant');
		$this->montant->setLabel("Montant (en €)")
			->setAttrib('placeholder', 'ex : 2000,50')
			->addValidator('Float', true)	
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(3,20))
			->setDecorators($decorators)
			->setRequired(true);

		$this->taux = new Zend_Form_Element_Text('taux');
		$this->taux->setLabel("Taux (en %)")
			->setAttrib('placeholder', 'ex : 4,25')
			->addValidator('Float', true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('Between', false, array('min' => 0, 'max' => 100))
			->setDecorators($decorators)
			->setRequired(true);

		$this->duree = new Zend_Form_Element_Text('duree');
		$this->duree->setLabel("Durée (en mois)")
			->setAttrib('placeholder', 'ex : 12')
			->addValidator('Digits', true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('Between', false, array('min' => 1, 'max' => 1200))
			->setDecorators($decorators)
			->setRequired(true);

		$this->dateE = new Zend_Form_Element_Text('dateE', array('readonly' => 'readonly', 'class' => 'datepickerNow'));
		$this->dateE->setLabel("Date d'effet")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		$this->autre = new Zend_Form_Element_Select('autre');
		$this->autre->setLabel("Autre prêt ?")
			->setDecorators($decorators)
			->setRequired(true)
			->addMultiOptions(array('' => '', 'Non'=>'Non','Oui'=>'Oui'));

		$this->type = new Zend_Form_Element_Select('type');
		$this->type->setLabel("Type de prêt")
			->setDecorators($decorators)
			->setRequired(true)
			->addMultiOptions(array('' => '', 'Amortissable'=>'Amortissable','In Fine'=>'In Fine'));

		$this->banque = new Zend_Form_Element_Select('banque');
		$this->banque->setLabel("Banque")
			->setDecorators($decorators)
			->addMultiOptions(array(''=>'','BNP Paribas'=>'BNP Paribas', 'Banque Populaire'=>'Banque Populaire', 'Banque Postale'=>'Banque Postale', 'Caisse d\'épargne'=>'Caisse d\'épargne', 'Crédit Agricole'=>'Crédit Agricole', 'LCL'=>'LCL', 'Société Générale'=>'Société Générale', 'Crédit Mutuel'=>'Crédit Mutuel', 'Barclays'=>'Barclays', 'CIC'=>'CIC', 'Crédit du Nord'=>'Crédit du Nord', 'Crédit Foncier de France'=>'Crédit Foncier de France', 'Crédit Immobilier de France'=>'Crédit Immobilier de France', 'HSBC'=>'HSBC', 'Autre'=>'Autre'	));

		$this->differe = new Zend_Form_Element_Text('differe');
		$this->differe->setLabel("Différé (en mois)")
			->setAttrib('placeholder', 'ex : 12')
			->addValidator('Digits', true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('Between', false, array('min' => 1, 'max' => 1200))
			->setDecorators($decorators);
		//FIN PROJET

		//DEBUT EMPRUNTEUR
		$this->civ = new Zend_Form_Element_Radio('civ');
		$this->civ->setLabel("Vous êtes")
			->setMultiOptions(array('M.'=>'M.','Mme.'=>'Mme.', 'Mlle.' => 'Mlle.'))
			->setDecorators($decorators)
			->setRequired(true)
			->setOptions(array('separator'=>''));
		               
		$this->nom = new Zend_Form_Element_Text('nom');
		$this->nom->setLabel("Votre Nom")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Remplacez les caractères spéciaux par un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);
					   
		$this->prenom = new Zend_Form_Element_Text('prenom');
		$this->prenom->setLabel("Votre Prénom")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Remplacez les caractères spéciaux par un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);

		$this->dateN = new Zend_Form_Element_Text('dateN', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->dateN->setLabel("Date de Naissance")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		$this->profession = new Zend_Form_Element_Select('profession');
		$this->profession->setLabel("Profession")
			->setDecorators($decorators)
			->addMultiOptions(array('' => '','Artisan'=>'Artisan','Commerçant'=>'Commerçant','Salarié Cadre'=>'Salarié Cadre','Salarié non cadre'=>'Salarié non cadre','Fonctionnaire'=>'Fonctionnaire','Auxiliaire Médical'=>'Auxiliaire Médical','Avocat'=>'Avocat','Expert-Ingénieur'=>'Expert-Ingénieur','Médecin'=>'Médecin','Pharmacien'=>'Pharmacien','Sans Profession'=>'Sans Profession','Autre'=>'Autre'	))
			->setRequired(true);

		$this->fumeur = new Zend_Form_Element_Radio('fumeur');
		$this->fumeur->setLabel("Êtes-vous fumeur ?")
			->setDecorators($decorators)
			->setOptions(array('separator'=>''))
			->addMultiOptions(array('Oui'=>'Oui','Non'=>'Non'))
			->setRequired(true);

		$this->quotite = new Zend_Form_Element_Select('quotite');
		$this->quotite->setLabel("Quotité à assurer")
			->setDecorators($decorators)
			->addMultiOptions(array(''=>'','5%'=>'5%', '10%'=>'10%', '15%'=>'15%', '20%'=>'20%', '25%'=>'25%', '30%'=>'30%', '35%'=>'35%', '40%'=>'40%', '45%'=>'45%', '50%'=>'50%', '55%'=>'55%', '60%'=>'60%', '65%'=>'65%', '70%'=>'70%', '75%'=>'75%', '80%'=>'80%', '85%'=>'85%', '90%'=>'90%', '95%'=>'95%', '100%'=>'100%'))
			->setRequired(true);

		$this->km = new Zend_Form_Element_Select('km');
		$this->km->setLabel("Nombre de km par an")
			->setDecorators($decorators)
			->addMultiOptions(array('- de 15.000'=>'- de 15.000', '+ de 15.000'=>'+ de 15.000'));

		// $this->IPT = new Zend_Form_Element_Radio('IPT');
		// $this->IPT->setLabel("Option IPT/ITT")
		// 	->setDecorators($decorators)
		// 	->setOptions(array('separator'=>''))
		// 	->addMultiOptions(array('Oui'=>'Oui','Non'=>'Non'))
		// 	->setRequired(true);

		// $this->IPP = new Zend_Form_Element_Radio('IPP');
		// $this->IPP->setLabel("Option IPP")
		// 	->setDecorators($decorators)
		// 	->setOptions(array('separator'=>''))
		// 	->addMultiOptions(array('Oui'=>'Oui','Non'=>'Non'))
		// 	->setRequired(true);

		$this->garantiesE = new Zend_Form_Element_Select('garantiesE');
		$this->garantiesE->setLabel("Garanties souhaitées")
			->setDecorators($decorators)
			->setRequired(true)
			->addMultiOptions(array('' => '', 'Décès'=>'Décès','Décès et Chômage'=>'Décès et Chômage', 'Décès et Option Arrêt de Travail/Invalidité'=>'Décès et Option Arrêt de Travail/Invalidité', 'Décès et Option Arrêt de Travail/Invalidité et Chômage'=>'Décès et Option Arrêt de Travail/Invalidité et Chômage'));

		$this->co = new Zend_Form_Element_Select('co');
		$this->co->setLabel("J'ai un co-emprunteur")
			->setDecorators($decorators)
			->addMultiOptions(array('Non'=>'Non', 'Oui'=>'Oui'));
		//FIN EMPRUNTEUR 

		//DEBUT CO-EMPRUNTEUR
		$this->civCo = new Zend_Form_Element_Radio('civCo');
		$this->civCo->setLabel("Vous êtes")
			->setMultiOptions(array('M.'=>'M.','Mme.'=>'Mme.', 'Mlle.' => 'Mlle.'))
			->setDecorators($decorators)
			->setOptions(array('separator'=>''));
		               
		$this->nomCo = new Zend_Form_Element_Text('nomCo');
		$this->nomCo->setLabel("Votre Nom")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Remplacez les caractères spéciaux par un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators);
					   
		$this->prenomCo = new Zend_Form_Element_Text('prenomCo');
		$this->prenomCo->setLabel("Votre Prénom")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Remplacez les caractères spéciaux par un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators);

		$this->dateNCo = new Zend_Form_Element_Text('dateNCo', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->dateNCo->setLabel("Date de Naissance")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		$this->professionCo = new Zend_Form_Element_Select('professionCo');
		$this->professionCo->setLabel("Profession")
			->setDecorators($decorators)
			->addMultiOptions(array('' => '','Artisan'=>'Artisan','Commerçant'=>'Commerçant','Salarié Cadre'=>'Salarié Cadre','Salarié non cadre'=>'Salarié non cadre','Fonctionnaire'=>'Fonctionnaire','Auxiliaire Médical'=>'Auxiliaire Médical','Avocat'=>'Avocat','Expert-Ingénieur'=>'Expert-Ingénieur','Médecin'=>'Médecin','Pharmacien'=>'Pharmacien','Sans Profession'=>'Sans Profession','Autre'=>'Autre'	));

		$this->fumeurCo = new Zend_Form_Element_Radio('fumeurCo');
		$this->fumeurCo->setLabel("Êtes-vous fumeur ?")
			->setDecorators($decorators)
			->setOptions(array('separator'=>''))
			->addMultiOptions(array('Oui'=>'Oui','Non'=>'Non'));

		$this->quotiteCo = new Zend_Form_Element_Select('quotiteCo');
		$this->quotiteCo->setLabel("Quotité à assurer")
			->setDecorators($decorators)
			->addMultiOptions(array(''=>'','5%'=>'5%', '10%'=>'10%', '15%'=>'15%', '20%'=>'20%', '25%'=>'25%', '30%'=>'30%', '35%'=>'35%', '40%'=>'40%', '45%'=>'45%', '50%'=>'50%', '55%'=>'55%', '60%'=>'60%', '65%'=>'65%', '70%'=>'70%', '75%'=>'75%', '80%'=>'80%', '85%'=>'85%', '90%'=>'90%', '95%'=>'95%', '100%'=>'100%'));

		$this->kmCo = new Zend_Form_Element_Select('kmCo');
		$this->kmCo->setLabel("Nombre de km par an")
			->setDecorators($decorators)
			->addMultiOptions(array('- de 15.000'=>'- de 15.000', '+ de 15.000'=>'+ de 15.000'));

		// $this->IPTCo = new Zend_Form_Element_Radio('IPTCo');
		// $this->IPTCo->setLabel("Option IPT/ITT")
		// 	->setDecorators($decorators)
		// 	->setOptions(array('separator'=>''))
		// 	->addMultiOptions(array('Oui'=>'Oui','Non'=>'Non'));

		// $this->IPPCo = new Zend_Form_Element_Radio('IPPCo');
		// $this->IPPCo->setLabel("Option IPP")
		// 	->setDecorators($decorators)
		// 	->setOptions(array('separator'=>''))
		// 	->addMultiOptions(array('Oui'=>'Oui','Non'=>'Non'));

		$this->garantiesC = new Zend_Form_Element_Select('garantiesC');
		$this->garantiesC->setLabel("Garanties souhaitées")
			->setDecorators($decorators)
			->addMultiOptions(array('' => '', 'Décès'=>'Décès','Décès et Chômage'=>'Décès et Chômage', 'Décès et Option Arrêt de Travail/Invalidité'=>'Décès et Option Arrêt de Travail/Invalidité', 'Décès et Option Arrêt de Travail/Invalidité et Chômage'=>'Décès et Option Arrêt de Travail/Invalidité et Chômage'));
		//FIN CO-EMPRUNTEUR 

		//DEBUT COORDONNEES
		$this->adresse = new Zend_Form_Element_Text('adresse');
		$this->adresse->setLabel("Votre Adresse ")
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);

		$this->codeP = new Zend_Form_Element_Text('codeP');
		$this->codeP->setLabel("Code Postal ")
			->addValidator('Digits') //que des chiffres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(2,5))
			->setDecorators($decorators)
			->setRequired(true);

		$this->ville = new Zend_Form_Element_Text('ville');
		$this->ville->setLabel("Votre Ville ")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);

		$this->email = new Zend_Form_Element_Text('email');
		$this->email->setLabel("Votre e-mail ")
				->setAttrib('placeholder', 'Format: you@you.me')
				->addValidator('StringLength', false,array(6,70))
				->addValidator('EmailAddress')
				->setDecorators($decorators)
				->setRequired(true);

		$this->telephone = new Zend_Form_Element_Text('telephone');
		$this->telephone->setLabel("Votre telephone ")
				->setAttrib('placeholder', 'Format : 0606060606')
				->addValidator('Digits')
				->setDecorators($decorators)
				->addValidator('StringLength', false,array(10,10))
				->setRequired(true);

		//FIN COORDONNEES
		$this->submit = new Zend_Form_Element_Submit('Envoyer');
		$this->submit->setDecorators(array('ViewHelper',
						array(array('td' => 'HtmlTag'), array('tag' => 'td', 'colspan' => 2)),
						array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))));

		$this->addElements(array(
			$this->montant,
			$this->taux,
			$this->duree,
			$this->dateE,
			$this->garanties,
			$this->autre,
			$this->type,
			$this->banque,
			$this->differe,
			$this->civ,
			$this->nom,
			$this->prenom,
			$this->dateN,
			$this->profession,
			$this->fumeur,
			$this->quotite,
			$this->km,
			$this->garantiesE,
			$this->co,
			$this->civCo,
			$this->nomCo,
			$this->prenomCo,
			$this->dateNCo,
			$this->professionCo,
			$this->fumeurCo,
			$this->quotiteCo,
			$this->kmCo,
			$this->garantiesC,
			$this->adresse,
			$this->codeP,
			$this->ville,
			$this->email,
			$this->telephone
		));

		$this->setDecorators(array('FormElements',array('HtmlTag', array('tag' => 'table')),'Form'));             
	}

	public function getMontant() { return $this->montant->getValue(); }
	public function getTaux() { return $this->taux->getValue(); }
	public function getDuree() { return $this->duree->getValue(); }
	public function getDateE() { return $this->dateE->getValue(); }
	public function getAutre() { return $this->autre->getValue(); }
	public function getType() { return $this->type->getValue(); }
	public function getBanque() { return $this->banque->getValue(); }
	public function getDiffere() { return $this->differe->getValue(); }

	public function getCivilite() { return $this->civ->getValue(); }
	public function getNom() { return $this->nom->getValue(); }
	public function getPrenom() { return $this->prenom->getValue(); }
	public function getDateN() { return $this->dateN->getValue(); }
	public function getProfession() { return $this->profession->getValue(); }
	public function getFumeur() { return $this->fumeur->getValue(); }
	public function getQuotite() { return $this->quotite->getValue(); }
	public function getKm() { return $this->km->getValue(); }
	public function getGarantiesE() { return $this->garantiesE->getValue(); }

	public function getCo() { return $this->co->getValue(); }

	public function getCivCo() { return $this->civCo->getValue(); }
	public function getNomCo() { return $this->nomCo->getValue(); }
	public function getPrenomCo() { return $this->prenomCo->getValue(); }
	public function getDateNCo() { return $this->dateNCo->getValue(); }
	public function getProfessionCo() { return $this->professionCo->getValue(); }
	public function getFumeurCo() { return $this->fumeurCo->getValue(); }
	public function getQuotiteCo() { return $this->quotiteCo->getValue(); }
	public function getKmCo() { return $this->kmCo->getValue(); }
	public function getGarantiesC() { return $this->garantiesC->getValue(); }

	public function getAdresse() { return $this->adresse->getValue(); }
	public function getCodeP() { return $this->codeP->getValue(); }
	public function getVille() { return $this->ville->getValue(); }
	public function getMail() { return $this->email->getValue(); }
	public function getTel() { return $this->telephone->getValue(); }
}
 ?>