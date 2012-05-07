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
			->addValidator('Alpha', true) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);
					   
		$this->prenom = new Zend_Form_Element_Text('prenom');
		$this->prenom->setLabel("Votre Prénom")
			->addValidator('Alpha', true) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);

		$this->nbenfant = new Zend_Form_Element_Select('nbenfant');
		$this->nbenfant->setLabel("Nombre d'enfants")
			->setDecorators($decorators)
			->addMultiOptions(array('aucun'=>'aucun','1'=>'1', '2'=>'2', '3'=>'3', 'plus de 3' => 'plus de 3'));

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
			->addValidator('Alpha') //que des lettres !
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
		$this->conjoint->setLabel("Ajouter mon conjoint")
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
		$this->q2->setLabel("J'ai de forts besoins optiques ou dentaires")
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

		$this->submit = new Zend_Form_Element_Submit('Envoyer');
		$this->submit->setDecorators(array('ViewHelper',
						array(array('td' => 'HtmlTag'), array('tag' => 'td', 'colspan' => 2)),
						array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))));

		$this->addElements(array(
			$this->civ,
			$this->nom,
			$this->prenom,
			$this->nbenfant,
			$this->email,
			$this->telephone,
			$this->codeP,
			$this->ville,
			$this->dateN,
			$this->conjoint,
			$this->dateNc,
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

	public function getCivilite() { return $this->civ->getValue(); }
	public function getNom() { return $this->nom->getValue(); }
	public function getPrenom() { return $this->prenom->getValue(); }
	public function getNbEnfant() { return $this->nbenfant->getValue(); }
	public function getMail() { return $this->email->getValue(); }
	public function getTel() { return $this->telephone->getValue(); }
	public function getCodeP() { return $this->codeP->getValue(); }
	public function getVille() { return $this->ville->getValue(); }

	public function getDateN() { return $this->dateN->getValue(); }
	public function getConjoint() { return $this->conjoint->getValue(); }
	public function getDateNC() { return $this->dateNC->getValue(); }
	public function getDate1() { return $this->date1->getValue(); }
	public function getDate2() { return $this->date2->getValue(); }
	public function getDate3() { return $this->date3->getValue(); }

	public function getQ1() { return $this->q1->getValue(); }
	public function getQ2() { return $this->q2->getValue(); }
	public function getQ3() { return $this->q3->getValue(); }
	public function getQ4() { return $this->q4->getValue(); }



}
?>