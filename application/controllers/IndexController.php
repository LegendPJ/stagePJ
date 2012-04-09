<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->title = "Bienvenue chez XYLAGROUP";
        $this->view->subMenu = "Qui sommes-nous ?";
        $this->view->module = $this->getRequest()->getModuleName(); 
        // recupere le module
        $this->view->controller = $this->getRequest()->getControllerName(); 
        // recupere le controller
        $this->view->action = $this->getRequest()->getActionName(); 
        // recupere l'action
    }


}

	