<?php

class XylassurController extends Zend_Controller_Action
{

    public function indexAction()
    {
	/* page d'accueil TOUT EST A RECUPERER EN BD */
	$this->view->title = "Je suis la page de Xylassur";
	$this->view->subTitle = "Assurance de Biens, de Responsabilités & de Finances";
	$this->view->nomXyla = "XylASSUR";
	$this->view->subNav = "";
	$this->view->module = $this->getRequest()->getModuleName(); 
	// recupere le module
	$this->view->controller = $this->getRequest()->getControllerName(); 
	// recupere le controller
	$this->view->action = $this->getRequest()->getActionName(); 
	// recupere l'action
    }


}

?>

	