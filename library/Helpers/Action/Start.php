<?php

class Helpers_Action_Start extends Zend_Controller_Action_Helper_Abstract
{
	protected $view;

	public function preDispatch()
	{
		$view = $this->getView();
		$this->view->module = $this->getRequest()->getModuleName(); 
		// recupere le module
		$this->view->controller = $this->getRequest()->getControllerName(); 
		// recupere le controller
		$this->view->action = $this->getRequest()->getActionName(); 
		// // recupere l'action
		// if ($this->getRequest()->getParam('loggedIn',false))
		// {
		// 	$view->signup = 'You are logged in';
		// }
		// else
		// {
		// 	$view->signup = 'sign up to our site!';
		// }

	}

	public function getView()
	{
		if (null !== $this->view)
		{
			return $this->view;
		}
		$controller = $this->getActionController();
		$this->view = $controller->view;
		return $this->view;
	}
}

?>