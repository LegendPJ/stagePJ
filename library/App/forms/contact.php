<?php 


class App_forms_contact extends Zend_Form 
{

                public function __construct() {

		$this->civilite = new Zend_Form_Element_Radio('civilite');
		$this->civilite->setLabel("Civilité :")
			->setMultiOptions(array('M.'=>'M.','Mme.'=>'Mme.'))
			->setOptions(array('separator'=>''));

		$this->civilite->setValue('M.');
		               
		$this->nom = new Zend_Form_Element_Text('nom');
		$this->nom->setLabel("Votre nom : ")
			->addValidator('Alpha') //que des lettres !
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

		$this->captcha= new Zend_Form_Element_Captcha('captcha', array(
			'label' => "Veuillez recopier le code ci dessous",
			'captcha' => array(
			'captcha' => 'image',
			'dotNoiseLevel' => 80, // Valeur initiale = 100
			'lineNoiseLevel' => 2, // Valeur initiale = 5
			'font'=>'C:/wamp/www/Xylagroup/public/css/arial.ttf'
			)
		));

		$this->submit = new Zend_Form_Element_Submit('Envoyer');

		$this->addElements(array(
			$this->civilite,
			$this->nom,
			$this->mail,
			$this->telephone,
			$this->message,
			$this->captcha
		));

		$this->setDecorators(array(
		'FormElements',
			array('HtmlTag', array('tag' => 'dl')),
				'Form'
		));             
	}

	public function getCivilite() { return $this->civilite->getValue(); }
	public function getNom() { return $this->nom->getValue(); }
	public function getEmail() { return $this->email->getValue(); }
	public function getTelephone() { return $this->telephone->getValue(); }
	public function getMessage() { return $this->message->getValue(); }
}
 ?>