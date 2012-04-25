<?php

class NewsController extends Zend_Controller_Action
{

	public function init()
	{	
		$this->view->int = $this->_getParam('id');
	}

	public function indexAction()
 	{
 		$this->view->autres 		= 	News::othersNews($this->view->int);
 	}

 	public function newsvueAction()
	{

		$this->view->theNews 	=	 News::findNews($this->view->int);
		$this->view->nPrec 		=	 News::findPrecNews($this->view->theNews[0]->date);
		$this->view->nNext 		=	 News::findNextNews($this->view->theNews[0]->date);
		$this->view->autres 		=	 News::findAll();
	}

	public function modifAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$this->_helper->layout->setLayout('layoutstart');
	}

}	