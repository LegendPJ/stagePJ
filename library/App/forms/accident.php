<?php 
class App_forms_accident extends Zend_Form 
{
	public function __construct() {

		$decorators =  array('ViewHelper', 'Errors',
				array('Description', array('tag' => 'p', 'class' => 'description')),
				array('HtmlTag', array('tag' => 'td')),
				array('Label', array('tag' => 'th')),
				array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
				);

		//IDENT
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

		$this->email = new Zend_Form_Element_Text('email');
		$this->email->setLabel("Votre e-mail ")
				->setAttrib('placeholder', 'Format: you@you.me')
				->addValidator('StringLength', false,array(6,70))
				// ->addValidator('EmailAddress')
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
		$this->adresse->setLabel("Votre adresse ")
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


		//CONTRAT
		$this->contrat = new Zend_Form_Element_Select('contrat');
		$this->contrat->setLabel("Type de contrat souhaité")
			->setDecorators($decorators)
			->setRequired(true)
			->addMultiOptions(array('Individuel'=>'Individuel', 'Familial' => 'Familial'));

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

		$this->nombreenfant = new Zend_Form_Element_Select('nombreenfant');
		$this->nombreenfant->setLabel("Nombre d'enfants à assurer")
			->setDecorators($decorators)
			->addMultiOptions(array('' => '', 'aucun' => 'aucun', '1'=>'1', '2'=>'2', '3'=>'3', '4' => '4', '5' => '5'));

		$this->nom1 = new Zend_Form_Element_Text('nom1');
		$this->nom1->setLabel("Nom du 1er enfant")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators);
					   
		$this->prenom1 = new Zend_Form_Element_Text('prenom1');
		$this->prenom1->setLabel("Prénom du 1er enfant")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
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

		$this->nom2 = new Zend_Form_Element_Text('nom2');
		$this->nom2->setLabel("Nom du 2e enfant")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators);
					   
		$this->prenom2 = new Zend_Form_Element_Text('prenom2');
		$this->prenom2->setLabel("Prénom du 2e enfant")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
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

		$this->nom3 = new Zend_Form_Element_Text('nom3');
		$this->nom3->setLabel("Nom du 3e enfant")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators);
					   
		$this->prenom3 = new Zend_Form_Element_Text('prenom3');
		$this->prenom3->setLabel("Prénom du 3e enfant")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
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

		$this->nom4 = new Zend_Form_Element_Text('nom4');
		$this->nom4->setLabel("Nom du 4er enfant")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators);
					   
		$this->prenom4 = new Zend_Form_Element_Text('prenom4');
		$this->prenom4->setLabel("Prénom du 4e enfant")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators);

		$this->date4 = new Zend_Form_Element_Text('date4', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->date4->setLabel("Date de naissance 4e enfant")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		$this->nom5 = new Zend_Form_Element_Text('nom5');
		$this->nom5->setLabel("Nom du 5e enfant")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators);
					   
		$this->prenom5 = new Zend_Form_Element_Text('prenom5');
		$this->prenom5->setLabel("Prénom du 5e enfant")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators);

		$this->date5 = new Zend_Form_Element_Text('date5', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->date5->setLabel("Date de naissance 5e enfant")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		$this->hide = new Zend_Form_Element_Hidden('hide');
		$this->hide->setDecorators($decorators)->setRequired(true);

		$this->cg = new Zend_Form_Element_Checkbox('cg');
		$this->cg->setDescription('Je déclare avoir pris connaissance dans conditions générales de vente relatives au contrat GAV')
			->setDecorators($decorators)
			->setRequired(true);

		$this->addElements(array(
			$this->civ,
			$this->nom,
			$this->prenom,
			$this->dateN,
			$this->email,
			$this->telephone,
			$this->adresse,
			$this->codeP,
			$this->ville,
			$this->contrat,
			$this->conjoint,
			$this->civC,
			$this->nomC,
			$this->prenomC,
			$this->dateC,
			$this->nombreenfant,
			$this->nom1,
			$this->prenom1,
			$this->date1,
			$this->nom2,
			$this->prenom2,
			$this->date2,
			$this->nom3,
			$this->prenom3,
			$this->date3,
			$this->nom4,
			$this->prenom4,
			$this->date4,
			$this->nom5,
			$this->prenom5,
			$this->date5,
			$this->hide,
			$this->cg
		));

		$this->setDecorators(array('FormElements',array('HtmlTag', array('tag' => 'table')),'Form'));             
	}
}
?>