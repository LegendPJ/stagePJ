<?php

class XylabtpController extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->nomXyla = "XylaBTP";
	}

	public function indexAction()
	{
		$this->view->en 		= 	Entite::findEntity(strtoupper($this->view->controller));
		$this->view->encEnti		= 	Encadre::findEncadreEntite($this->view->en[0]->id); 
								//on récupère les encadre relatifs à l'entité (XYLABTP)
	}


}

?>

