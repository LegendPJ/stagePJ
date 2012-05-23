<?php

class PagesController extends Zend_Controller_Action
{

	public function init()
	{

	}

	public function conditionsAction(){} //check

	public function mentionsAction(){} //check

	public function planAction(){} // a revoir

	public function contactAction(){
		$this->view->mdp = "monmotdepasse";
		$crypt = new Webf_RevCrypt("aDrtfdhDPSGKbsnoDVOJOSJBqgrZPSJBRJHBNSbsxjbosxx");
		$this->view->encod = $crypt->code($this->view->mdp);
		$this->view->decod = $crypt->decode("0tKg0dCtx5fSw9jZmQ== ");
	} 

}	