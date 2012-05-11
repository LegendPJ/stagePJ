<?php 
class App_forms_hidden extends Zend_Form 
{
	public function __construct() {

		$decorators =  array('ViewHelper', 'Errors',
				array('Description', array('tag' => 'p', 'class' => 'description')),
				array('HtmlTag', array('tag' => 'td')),
				array('Label', array('tag' => 'th')),
				array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
				);

		//IDENT
		$this->hide = new Zend_Form_Element_Hidden('hide');
		$this->hide->setDecorators($decorators)->setRequired(true);

		$this->cg = new Zend_Form_Element_Checkbox('cg');
		$this->cg->setDescription('Je déclare avoir pris connaissance dans conditions générales de vente relatives au contrat GAV')
			->setDecorators($decorators)
			->setRequired(true);

		$this->addElements(array(
			$this->hide,
			$this->cg
		));
		$this->setDecorators(array('FormElements',array('HtmlTag', array('tag' => 'table')),'Form'));             
	}

}
?>