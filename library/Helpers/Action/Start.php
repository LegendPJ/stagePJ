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
		$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
		$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
		$this->view->date = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");

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