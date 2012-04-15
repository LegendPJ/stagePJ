<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->module = $this->getRequest()->getModuleName(); 
		//on recupere le module
		$this->view->controller = $this->getRequest()->getControllerName(); 
		//on recupere le controller
		$this->view->action = $this->getRequest()->getActionName(); 
		//on recupere l'action
	}

	public function indexAction()
	{
		$entiteAccueil 			= 	Entite::findAccueil(); //on recupere la ligne d'ACCUEIL
		$this->view->encadreAccueil 	= 	Encadre::findEncadreEntite($entiteAccueil[0]->id); //on récupère les encadre relatifs à ACCUEIL
		$this->view->last 		= 	News::findLastNews(); //on récupère la denière news
	}

}	