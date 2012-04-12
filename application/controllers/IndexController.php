<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		////////////////////////////////////////////////////////////////////////
		//a remettre en dessous si ça ne fonctionne plus !
		$this->view->module = $this->getRequest()->getModuleName(); 
		// recupere le module
		$this->view->controller = $this->getRequest()->getControllerName(); 
		// recupere le controller
		$this->view->action = $this->getRequest()->getActionName(); 
		// recupere l'action
		////////////////////////////////////////////////////////////////////////
	}

	public function indexAction()
	{
		// Pour récupérer les encadre de l'Accueil à refaire
		foreach (Entite::findAccueil() as $entite) {
			$this->view->encadreAccueil = Encadre::findEncadreAccueil($entite->id);
		}

		$this->view->first = News::findFirstNews();
	}

	public function newsdayAction()
	{
		$this->view->int = $this->_getParam('id');
		$this->view->theNews = News::findNews($this->view->int);
		
	}

}	