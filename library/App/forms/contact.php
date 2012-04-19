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
			->addValidator('notEmpty')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setRequired(true);

		$this->email = new Zend_Form_Element_Text('email');
		$this->email->setLabel("Votre e-mail : ")
			->addValidator('notEmpty')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setRequired(true);

		$this->telephone = new Zend_Form_Element_Text('telephone');
		$this->telephone->setLabel("Tel : ")
			->addValidator('notEmpty')
			->setRequired(true);
		                
		$this->message = new Zend_Form_Element_Textarea('message');
		$this->message->setLabel("Votre message : ")
		                                ->setRequired(true);

		$this->submit = new Zend_Form_Element_Submit('Envoyer');

		$this->addElements(array(
			$this->civilite,
			$this->nom,
			$this->mail,
			$this->telephone,
			$this->message
		));

		$this->setDecorators(array(
		'FormElements',
			array('HtmlTag', array('tag' => 'dl')),
				'Form'
		));             
	}

	public function getCivilite() {
		
		return $this->civilite->getValue();
	}

	public function getNom() {
		
		return $this->nom->getValue();
	}
              
	public function getEmail() {
		
		return $this->email->getValue();
	}

	public function getTelephone() {
		
		return $this->telephone->getValue();
	}

	public function getMessage() {
		
		return $this->message->getValue();
	}
}
 ?>