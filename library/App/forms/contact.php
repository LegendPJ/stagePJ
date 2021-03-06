<?php 


class App_forms_contact extends Zend_Form 
{

                public function __construct() {

		$this->civilite = new Zend_Form_Element_Radio('civilite');
		$this->civilite->setLabel("Civilité :")
			->setMultiOptions(array('M.'=>'M.','Mme.'=>'Mme.', 'Mlle.' => 'Mlle.'))
			->setOptions(array('separator'=>''));

		$this->civilite->setValue('M.');
		               
		$this->nom = new Zend_Form_Element_Text('nom');
		$this->nom->setLabel("Votre nom : ")
			->addValidator('Alpha', true, array('allowWhiteSpace' => true, 'messages' => 'Cette valeur ne contient pas que des lettres, pour les caractères spéciaux mettez un espace')) //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setRequired(true);

		$this->email = new Zend_Form_Element_Text('email');
		$this->email->setLabel("Votre e-mail : ")
				->setAttrib('placeholder', 'Format: you@you.me')
				->addValidator('StringLength', false,array(6,70))
				->addValidator('EmailAddress')
				->setRequired(true);

		$this->telephone = new Zend_Form_Element_Text('telephone');
		$this->telephone->setLabel("Telephone : ")
				->setAttrib('placeholder', 'Format : 0606060606')
				->addValidator('Digits')
				->addValidator('StringLength', false,array(10,10))
				->setRequired(true);
		                
		$this->message = new Zend_Form_Element_Textarea('message');
		$this->message->setLabel("Votre message : ")
		                                ->setRequired(true);

		$this->addElements(array(
			$this->civilite,
			$this->nom,
			$this->email,
			$this->telephone,
			$this->message
		));

		$this->setDecorators(array(
		'FormElements',
			array('HtmlTag', array('tag' => 'dl')),
				'Form'
		));             
	}
}
 ?>