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
		$this->view->mdp = "";
		$crypt = new Webf_RevCrypt("");
		$this->view->encod = $crypt->code($this->view->mdp);
		$this->view->decod = $crypt->decode("");
	} 

}	