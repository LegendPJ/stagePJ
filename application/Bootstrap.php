<?php

	// require (dirname(__FILE__).'/global.php');
	// Zend_Controller_Front::run(dirname(__FILE__).'/controllers');

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initPlaceholders()
	{
		$this->bootstrap('View');
		$view = $this->getResource('View');
		$view->doctype('HTML5');

		// Titre et séparateur
		$view->headTitle('Xylagroup')
				->setSeparator(' :: ');

		// Feuilles de style
		$view->headLink()->prependStylesheet('/css/global.css');
		$view->headLink()->prependStylesheet('/css/bmin.css');

		// Fichiers jQuery
		$view->headScript()->prependFile('/js/footer.js');
		$view->headScript()->prependFile('/js/bootstrap-tab.js');	
		$view->headScript()->prependFile('/js/menuActive.js');
		$view->headScript()->prependFile('/js/bootstrap-dropdown.js');
		$view->headScript()->prependFile('/js/jquery-1.7.1.min.js');

	}
}

