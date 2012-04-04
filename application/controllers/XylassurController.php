<?php

class XylassurController extends Zend_Controller_Action
{

    public function indexAction()
    {
    	 /* page d'accueil*/
        $this->view->title = "Je suis la page de Xylassur";
        $this->view->nomXyla = "XylASSUR";
    }


}

?>

	