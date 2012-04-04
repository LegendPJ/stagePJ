<?php

class XylabtpController extends Zend_Controller_Action
{

    public function indexAction()
    {
    	 /* page d'accueil*/
	$this->view->title = "Je suis la page de Xylabtp";
	$this->view->nomXyla = "XylaBTP";
    }


}

?>

	