<?php 
class App_forms_prevoyance extends Zend_Form 
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

		$this->statut = new Zend_Form_Element_Select('statut');
		$this->statut->setLabel('Votre statut ')
			->setDecorators($decorators)
			->setRequired(true)
			->addMultiOptions(array('' => '', 'Salarié'=>'Salarié','TNS'=>'TNS', 'Retraité' => 'Retraité'));

		$this->demande = new Zend_Form_Element_MultiCheckbox('demande', array(
			'multiOptions' => array('Une garantie décès' => 'Une garantie décès' ,
						'Une garantie d\'incapacité' => 'Une garantie d\'incapacité',
						'Une garantie d\'invalidité' => 'Une garantie d\'invalidité'
					)));

		$this->demande->setDecorators($decorators)
				->setSeparator('')
				->setRequired(true)
				->setLabel("Votre demande (1 choix mini)");

		$this->message = new Zend_Form_Element_Textarea('message');
		$this->message->setLabel("Votre message : ")
				->setDecorators($decorators);

		$this->addElements(array(
			$this->civ,
			$this->nom,
			$this->prenom,
			$this->email,
			$this->telephone,
			$this->statut,
			$this->message
		));

		$this->setDecorators(array('FormElements',array('HtmlTag', array('tag' => 'table')),'Form'));             
	}
}
?>