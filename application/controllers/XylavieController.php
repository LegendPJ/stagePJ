<?php

class XylavieController extends Zend_Controller_Action
{

    public function indexAction()
    {
    	 /* page d'accueil*/
        $this->view->title = "Je suis la page de Xylavie";
        $this->view->nomXyla = "XylaVIE";
    }


}

?>

	