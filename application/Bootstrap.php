<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initPlaceholders()
	{
		$this->bootstrap('View');
		$view = $this->getResource('View');
		$view->doctype('HTML5');

		// Titre et séparateur
		$view->headTitle('Xylagroup');

		// Feuille de style
		$view->headLink()->prependStylesheet('/css/global.css');

		// Fichier jQuery
		$view->headScript()->prependFile('/js/site.js');
	}
}

