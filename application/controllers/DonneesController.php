<?php

class DonneesController extends Zend_Controller_Action
{

	public function init()
	{

	}

	public function indexAction()
	{
		$this->_helper->layout->setLayout('layoutdonnees');
		
		if ($this->getRequest()->isPost())
		{
			$adapter = new Donnees_Auth_Adapter($this->_getParam('username'), $this->_getParam('password'));
			$result = Zend_Auth::getInstance()->authenticate($adapter);

			if (Zend_Auth::getInstance()->hasIdentity())
				$this->_forward('start');
			else
				$this->view->message = implode(' ' ,$result->getMessages());

		}
	}

	public function startAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
	}

	public function logoutAction()
	{
		Zend_Auth::getInstance()->clearIdentity();
		$this->_redirect('/donnees/');
	}

}	