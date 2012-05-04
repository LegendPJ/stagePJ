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

		$this->submit = new Zend_Form_Element_Submit('Envoyer');
		$this->submit->setDecorators(array('ViewHelper',
						array(array('td' => 'HtmlTag'), array('tag' => 'td', 'colspan' => 2)),
						array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))));

		$this->addElements(array(
			$this->civ,
			$this->nom,
			$this->prenom,
			$this->dateN,
			$this->profession
		));

		$this->setDecorators(array('FormElements',array('HtmlTag', array('tag' => 'table')),'Form'));             
	}

	public function getCivilite() { return $this->civ->getValue(); }

	public function getNom() { return $this->nom->getValue(); }
	
	public function getPrenom() { return $this->prenom->getValue(); }

	public function getDateN() { return $this->dateN->getValue(); }

	public function getProfession() { return $this->profession->getValue(); }

}
?>