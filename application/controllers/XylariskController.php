<?php

class XylariskController extends Zend_Controller_Action
{

	public function init()
	{
		/* page d'accueil*/
		$this->view->title = "Je suis la page de Xylarisk";
		$this->view->nomXyla = "XylaRISK";	
		$this->view->module = $this->getRequest()->getModuleName(); 
		// recupere le module
		$this->view->controller = $this->getRequest()->getControllerName(); 
		// recupere le controller
		$this->view->action = $this->getRequest()->getActionName(); 
		// recupere l'action
	}

	public function indexAction()
	{
		
	}
}

?>

