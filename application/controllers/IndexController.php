<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->title = "je suis xylagroup";
        //$this->view->nomXyla = "XylaGROUP";
    }


}

	