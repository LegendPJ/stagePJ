<?php 


class App_forms_dependance extends Zend_Form 
{

	public function __construct() {

		$decorators =  array(
				'ViewHelper',
				'Errors',
				array('Description', array('tag' => 'p', 'class' => 'description')),
				array('HtmlTag', array('tag' => 'td')),
				array('Label', array('tag' => 'th')),
				array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
		);

		$this->civilite = new Zend_Form_Element_Radio('civilite');
		$this->civilite->setLabel("Vous êtes :")
			->setMultiOptions(array('M.'=>'M.','Mme.'=>'Mme.', 'Mlle' => 'Mlle'))
			->setDecorators($decorators)
			->setOptions(array('separator'=>''));

		$this->civilite->setValue('M.');
		               
		$this->nom = new Zend_Form_Element_Text('nom');
		$this->nom->setLabel("Votre Nom :")
			->addValidator('Alpha') //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);
					   
		$this->prenom = new Zend_Form_Element_Text('prenom');
		$this->prenom->setLabel("Votre Prénom : ")
			->addValidator('Alpha') //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);

		$this->conjoint = new Zend_Form_Element_Radio('conjoint');
		$this->conjoint->setLabel("Ajouter votre conjoint :")
			->setMultiOptions(array('Oui'=>'Oui','Non'=>'Non'))
			->setDecorators($decorators)
			->setOptions(array('separator'=>''));

		$this->conjoint->setValue('Non');

		$this->submit = new Zend_Form_Element_Submit('Envoyer');
		$this->submit->setDecorators(array(
						            'ViewHelper',
						            array(array('td' => 'HtmlTag'), array('tag' => 'td', 'colspan' => 2)),
						            array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
       							 )
						);



		$this->addElements(array(
			$this->nom,
			$this->prenom,
			$this->conjoint
		));

		$this->setDecorators(array('FormElements',
				array('HtmlTag', array('tag' => 'table')),
				'Form'
					)
				);             
	}

	public function getCivilite() {
		
		return $this->prenom->getValue();
	}

	public function getNom() {
		
		return $this->nom->getValue();
	}
			  
	
}
 ?>