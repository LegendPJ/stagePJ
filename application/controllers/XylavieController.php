<?php

class XylavieController extends Zend_Controller_Action
{

    public function indexAction()
    {
    	 /* page d'accueil*/
	$this->view->title = "Je suis la page de Xylavie";
	$this->view->nomXyla = "XylaVIE";
	
	$this->view->module = $this->getRequest()->getModuleName(); 
	// recupere le module
	$this->view->controller = $this->getRequest()->getControllerName(); 
	// recupere le controller
	$this->view->action = $this->getRequest()->getActionName(); 
	// recupere l'action
    }


}

?>

	