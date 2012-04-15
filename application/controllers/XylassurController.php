<?php

class XylassurController extends Zend_Controller_Action
{

	public function init()
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

	public function indexAction()
	{
		$this->view->en 		= 	Entite::findEntity(strtoupper($this->view->controller));
		$this->view->encEnti		= 	Encadre::findEncadreEntite($this->view->en[0]->id); 
								//on récupère les encadre relatifs à l'entité (XYLASSUR)
	}


}

?>

