<?php 
class App_forms_retraitepargne extends Zend_Form 
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
			->setRequired()
			->setOptions(array('separator'=>''));
		               
		$this->nom = new Zend_Form_Element_Text('nom');
		$this->nom->setLabel("Votre Nom")
			->addValidator('Alpha') //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);
					   
		$this->prenom = new Zend_Form_Element_Text('prenom');
		$this->prenom->setLabel("Votre Prénom")
			->addValidator('Alpha') //que des lettres !
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

		$this->adresse = new Zend_Form_Element_Text('adresse');
		$this->adresse->setLabel("Votre Adresse")
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);

		$this->codeP = new Zend_Form_Element_Text('codeP');
		$this->codeP->setLabel("Code Postal")
			->addValidator('Digits') //que des chiffres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(2,5))
			->setDecorators($decorators)
			->setRequired(true);

		$this->ville = new Zend_Form_Element_Text('ville');
		$this->ville->setLabel("Votre Ville")
			->addValidator('Alpha') //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);

		$this->email = new Zend_Form_Element_Text('email');
		$this->email->setLabel("Votre e-mail")
				->setAttrib('placeholder', 'Format: you@you.me')
				->addValidator('StringLength', false,array(6,70))
				->addValidator('EmailAddress')
				->setDecorators($decorators)
				->setRequired(true);

		$this->telephone = new Zend_Form_Element_Text('telephone');
		$this->telephone->setLabel("Votre telephone")
				->setAttrib('placeholder', 'Format : 0606060606')
				->addValidator('Digits')
				->setDecorators($decorators)
				->addValidator('StringLength', false,array(10,10))
				->setRequired(true);

		$this->avenir = new Zend_Form_Element_Select('avenir');
		$this->avenir->setLabel('Comment voyez-vous l\'avenir')
			->setDecorators($decorators)
			->setRequired(true)
			->addMultiOptions(array(' ' => ' ', 'Confiant'=>'Confiant','Très Confiant'=>'Très Confiant', 'Inquiet'=>'Inquiet', 'Très Inquiet'=>'Très Inquiet'));

		$this->projets = new Zend_Form_Element_MultiCheckbox('projets', array(
			'multiOptions' => array('Epargner' => 'Epargner pour vous mettre à l\'abri d\'un coup dur ou vous constituer une épargne.' ,
						'Préparer' => 'Préparer l\'achat d\'un bien.',
						'Financer' => 'Financer les études et/ou l\'installation de vos enfants.',
						'Fructifier' => 'Faire fructifier une somme dont vous disposez déjà.',
						'Rechercher' => 'Rechercher un rendement maximal en acceptant une prise de risques.',
						'Transmettre' => 'Transmettre tout ou partie de votre épargne à vos enfants, petits enfants.',
						'Rémunérer' => 'Rémunérer votre épargne de précaution sans prendre de risque.',
						'Retraite' => 'Préparer la retraite de vos souhaits.',
						'Bénéficier' => 'Bénéficier d\'un complément de ressources.',
						'Impôts' => 'Payer moins d\'impôts.'
					)));
		$this->projets->setDecorators($decorators)
				->setSeparator('')
				->setRequired(true)
				->setLabel("Vous souhaitez (1 choix mini)");

		$this->submit = new Zend_Form_Element_Submit('Envoyer');
		$this->submit->setDecorators(array('ViewHelper',
						array(array('td' => 'HtmlTag'), array('tag' => 'td', 'colspan' => 2)),
						array(array('tr' => 'HtmlTag'), array('tag' => 'tr')))
						);

		$this->addElements(array(
			$this->civ,
			$this->nom,
			$this->prenom,
			$this->dateN,
			$this->adresse,
			$this->codeP,
			$this->ville,
			$this->email,
			$this->telephone,
			$this->avenir,
			$this->projets
		));

		$this->setDecorators(array('FormElements',
					array('HtmlTag', array('tag' => 'table')),
				'Form'));             
	}

	public function getCivilite() { return $this->civ->getValue(); }
	public function getNom() { return $this->nom->getValue(); }
	public function getPrenom() { return $this->prenom->getValue(); }	
	public function getDateN() { return $this->dateN->getValue(); }	
	public function getAdresse() { return $this->adresse->getValue(); }
	public function getCodeP() { return $this->codeP->getValue(); }
	public function getVille() { return $this->ville->getValue(); }
	public function getMail() { return $this->email->getValue(); }
	public function getTel() { return $this->telephone->getValue(); }	
	public function getAvenir() { return $this->avenir->getValue(); }
	public function getProjets() { return $this->projets->getValue(); }
}
 ?>