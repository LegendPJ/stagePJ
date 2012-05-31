<?php

class DonneesController extends Zend_Controller_Action
{

	public function init() {}

	public function indexAction()
	{
		$this->_helper->layout->setLayout('layoutdonnees');
		
		if ($this->getRequest()->isPost())
		{
			$crypt = new Webf_RevCrypt("");
			$ul = $crypt->code($this->_getParam('username'));
			$pm = $crypt->code($this->_getParam('password'));
			$adapter = new Donnees_Auth_Adapter($ul, $pm);
			$result = Zend_Auth::getInstance()->authenticate($adapter);
			if (Zend_Auth::getInstance()->hasIdentity())
				$this->_forward('start');
			else
				$this->view->message = implode(' ' ,$result->getMessages());
		}
	}

	public function startAction()
	{
		$this->_helper->layout->setLayout('layoutstart');
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
	}

	public function logoutAction()
	{	
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		Zend_Auth::getInstance()->clearIdentity();
		$this->_redirect('/donnees/');
	}

}