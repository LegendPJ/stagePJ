<?php

class PagesController extends Zend_Controller_Action
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

	public function conditionsAction(){} //check

	public function mentionsAction(){} //check

	public function planAction(){} // a revoir

	public function contactAction(){} 

}	