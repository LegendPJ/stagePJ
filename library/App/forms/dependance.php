<?php 
class App_forms_dependance extends Zend_Form 
{
	public function __construct() {

		$decorators =  array('ViewHelper', 'Errors',
				array('Description', array('tag' => 'p', 'class' => 'description')),
				array('HtmlTag', array('tag' => 'td')),
				array('Label', array('tag' => 'th')),
				array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
				);

		$this->civ = new Zend_Form_Element_Radio('civ');
		$this->civ->setLabel("Vous êtes ")
			->setMultiOptions(array('M.'=>'M.','Mme.'=>'Mme.', 'Mlle.' => 'Mlle.'))
			->setDecorators($decorators)
			->setRequired()
			->setOptions(array('separator'=>''));
		               
		$this->nom = new Zend_Form_Element_Text('nom');
		$this->nom->setLabel("Votre Nom ")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);
					   
		$this->prenom = new Zend_Form_Element_Text('prenom');
		$this->prenom->setLabel("Votre Prénom  ")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
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

		$this->conjoint = new Zend_Form_Element_Select('conjoint');
		$this->conjoint->setLabel('Ajouter votre conjoint(e) ')
			->setDecorators($decorators)
			->addMultiOptions(array('Non'=>'Non','Oui'=>'Oui'));

		$this->civC = new Zend_Form_Element_Radio('civC');
		$this->civC->setLabel("Votre conjoint(e) ")
			->setMultiOptions(array('M.'=>'M.','Mme.'=>'Mme.', 'Mlle.' => 'Mlle.'))
			->setDecorators($decorators)
			->setOptions(array('separator'=>''));
		               
		$this->nomC = new Zend_Form_Element_Text('nomC');
		$this->nomC->setLabel("Son Nom ")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators);
					   
		$this->prenomC = new Zend_Form_Element_Text('prenomC');
		$this->prenomC->setLabel("Son Prénom ")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators);

		$this->dateC = new Zend_Form_Element_Text('dateC', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->dateC->setLabel("Sa date de naissance ")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

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

		$this->rente = new Zend_Form_Element_Select('rente');
		$this->rente->setLabel("Montant de votre rente ")
			->setDecorators($decorators)
			->setRequired(true)
			->addMultiOptions(array('' => '', '200€'=>'200€','400€'=>'400€', '600€'=>'600€', '800€'=>'800€', '1000€' => '1000€', '1200€' => '1200€', 'plus de 1200€' => 'plus de 1200€'));

		$this->depT = new Zend_Form_Element_Select('depT');
		$this->depT->setLabel("Dépendance Totale ")
			->setDecorators($decorators)
			->setRequired(true)
			->addMultiOptions(array('' => '', 'Non'=>'Non','Oui'=>'Oui'));

		$this->depTP = new Zend_Form_Element_Select('depTP');
		$this->depTP->setLabel("Dépendance Totale ou Partielle ")
			->setDecorators($decorators)
			->setRequired(true)
			->addMultiOptions(array('' => '', 'Non'=>'Non','Oui'=>'Oui'));

		$this->addElements(array(
			$this->civ,
			$this->nom,
			$this->prenom,
			$this->dateN,
			$this->conjoint,
			$this->civC,
			$this->nomC,
			$this->prenomC,
			$this->dateC,
			$this->adresse,
			$this->codeP,
			$this->ville,
			$this->email,
			$this->telephone,
			$this->rente,
			$this->depT,
			$this->depTP
		));

		$this->setDecorators(array('FormElements',
					array('HtmlTag', array('tag' => 'table')),
				'Form'));             
	}
}
 ?>