<?php

class XylariskController extends Zend_Controller_Action
{

    public function indexAction()
    {
    	 /* page d'accueil*/
	$this->view->title = "Je suis la page de Xylarisk";
	$this->view->nomXyla = "XylaRISK";
    }


}

?>

	