<?php

class XylabtpController extends Zend_Controller_Action
{

    public function indexAction()
    {
    	 /* page d'accueil*/
	$this->view->title = "Je suis la page de XylaBTP";
	$this->view->nomXyla = "XylaBTP";
	$this->view->module = $this->getRequest()->getModuleName(); 
	// recupere le module
	$this->view->controller = $this->getRequest()->getControllerName(); 
	// recupere le controller
	$this->view->action = $this->getRequest()->getActionName(); 
	// recupere l'action
    }


}

?>

	