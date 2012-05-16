<?php 
class App_forms_sante extends Zend_Form 
{
	public function __construct() {

		$decorators =  array('ViewHelper', 'Errors',
				array('Description', array('tag' => 'p', 'class' => 'description')),
				array('HtmlTag', array('tag' => 'td')),
				array('Label', array('tag' => 'th')),
				array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
				);

		//IDENTIFICATION
		$this->civ = new Zend_Form_Element_Radio('civ');
		$this->civ->setLabel("Vous êtes")
			->setMultiOptions(array('M.'=>'M.','Mme.'=>'Mme.', 'Mlle.' => 'Mlle.'))
			->setDecorators($decorators)
			->setRequired(true)
			->setOptions(array('separator'=>''));
		               
		$this->nom = new Zend_Form_Element_Text('nom');
		$this->nom->setLabel("Votre Nom")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);
					   
		$this->prenom = new Zend_Form_Element_Text('prenom');
		$this->prenom->setLabel("Votre Prénom")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);

		$this->nbenfant = new Zend_Form_Element_Select('nbenfant');
		$this->nbenfant->setLabel("Nombre d'enfants")
			->setDecorators($decorators)
			->setRequired(true)
			->addMultiOptions(array('' => '', 'aucun'=>'aucun','1'=>'1', '2'=>'2', '3'=>'3', 'plus de 3' => 'plus de 3'));

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

		// FAMILLE
		$this->dateN = new Zend_Form_Element_Text('dateN', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->dateN->setLabel("Votre date de Naissance")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		$this->conjoint = new Zend_Form_Element_Select('conjoint');
		$this->conjoint->setLabel("Ajouter votre conjoint(e)")
			->setDecorators($decorators)
			->addMultiOptions(array('Non'=>'Non', 'Oui' => 'Oui'));

		$this->dateNC = new Zend_Form_Element_Text('dateNC', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->dateNC->setLabel("Sa date de naissance")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		$this->date1 = new Zend_Form_Element_Text('date1', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->date1->setLabel("Date de naissance 1er enfant")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		$this->date2 = new Zend_Form_Element_Text('date2', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->date2->setLabel("Date de naissance 2e enfant")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		$this->date3 = new Zend_Form_Element_Text('date3', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->date3->setLabel("Date de naissance 3e enfant")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		//BESOINS
		$this->q1 = new Zend_Form_Element_Radio('q1');
		$this->q1->setLabel("Je consulte régulièrement des spécialistes")
			->setMultiOptions(array('Oui'=>'Oui', 'Non' => 'Non'))
			->setDecorators($decorators)
			->setRequired(true)
			->setOptions(array('separator'=>''));

		$this->q2 = new Zend_Form_Element_Radio('q2');
		$this->q2->setLabel("J'ai de forts besoins optique ou dentaire")
			->setMultiOptions(array('Oui'=>'Oui', 'Non' => 'Non'))
			->setDecorators($decorators)
			->setRequired(true)
			->setOptions(array('separator'=>''));

		$this->q3 = new Zend_Form_Element_Radio('q3');
		$this->q3->setLabel("Je souhaite être remboursé de la chambre particulière ou des frais annexes lors de mon hospitalisation")
			->setMultiOptions(array('Oui'=>'Oui', 'Non' => 'Non'))
			->setDecorators($decorators)
			->setRequired(true)
			->setOptions(array('separator'=>''));

		$this->q4 = new Zend_Form_Element_MultiCheckbox('q4', array(
			'multiOptions' => array('osteopathie' => 'Ostéopathie' ,
						'acupunture' => 'Acupuncture',
						'homeopathie' => 'Homeopathie',
						'chiropractie' => 'Chiropractie',
						'kinesitherapie' => 'Micro Kinésithérapie'
					)));
		$this->q4->setDecorators($decorators)
				->setSeparator('')
				->setLabel("Avez-vous recours à des médecines naturelles ?");

		$this->addElements(array(
			$this->civ,
			$this->nom,
			$this->prenom,
			$this->nbenfant,
			$this->email,
			$this->telephone,
			$this->adresse,
			$this->codeP,
			$this->ville,
			$this->dateN,
			$this->conjoint,
			$this->dateNC,
			$this->date1,
			$this->date2,
			$this->date3,
			$this->q1,
			$this->q2,
			$this->q3,
			$this->q4
		));

		$this->setDecorators(array('FormElements',array('HtmlTag', array('tag' => 'table')),'Form'));             
	}
}
?>