<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initDoctrine() 
	{
		$this->getApplication()->getAutoloader()
		               ->pushAutoloader(array('Doctrine', 'autoload'));
		spl_autoload_register(array('Doctrine', 'modelsAutoload'));
		$manager = Doctrine_Manager::getInstance();
		$manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
		$manager->setAttribute(
		    Doctrine::ATTR_MODEL_LOADING,
		    Doctrine::MODEL_LOADING_CONSERVATIVE
		);
		$manager->setAttribute(Doctrine::ATTR_AUTOLOAD_TABLE_CLASSES, true);

		$doctrine = $this->getOption('doctrine');

		        Doctrine::loadModels($doctrine['models_path']);

		$conn = Doctrine_Manager::connection($doctrine['dsn'], 'doctrine');
		$conn->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, true);
		return $conn;
	}

	protected function _initPlaceholders()
	{
		$this->bootstrap('View');
		$view = $this->getResource('View');
		$view->doctype('HTML5');

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

