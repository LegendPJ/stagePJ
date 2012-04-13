<?php

class NewsController extends Zend_Controller_Action
{

	public function init()
	{	
		$this->view->module = $this->getRequest()->getModuleName(); 
		// recupere le module
		$this->view->controller = $this->getRequest()->getControllerName(); 
		// recupere le controller
		$this->view->action = $this->getRequest()->getActionName(); 
		// recupere l'action
		$this->view->int = $this->_getParam('id');
	}

	public function indexAction()
 	{
 		$this->view->autres 	= 	News::othersNews($this->view->int);
 	}

 	public function newsvueAction()
	{

		$this->view->theNews 	=	 News::findNews($this->view->int);
		$this->view->nPrec 	=	 News::findPrecNews($this->view->theNews[0]->date);
		$this->view->nNext 	=	 News::findNextNews($this->view->theNews[0]->date);
		$this->view->autres 	=	 News::findAll();
	}

}	