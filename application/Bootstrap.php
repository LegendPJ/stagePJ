<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAppAutoload()
	{
                $moduleLoader = new Zend_Application_Module_Autoloader(array(
                        'namespace' => '',
                        'basePath' => APPLICATION_PATH));

                $autoloader = Zend_Loader_Autoloader::getInstance();
                $autoloader->registerNamespace(array('App_'));
                
                return $moduleLoader;


	}

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
		$conn->execute("SET CHARACTER SET utf8"); /* Pour que Doctrine utilise l'UTF8 !!! :) */
		return $conn;
	}

	public function _initTranslate()
	{
	// On définit la langue sur le français
	$language = 'fr';

	// On définit le traducteur à utiliser
	$translate = new Zend_Translate(
		array(	'adapter' => 'array',
			'content' => APPLICATION_PATH . '/../library/resources/languages', //ici, cela dépendra de tes dossiers, mais si tu as suivi les normes le dossier "resources" se trouve au même niveau qu'application, et le boostrap dans application.
			'locale'  => $language,
			'scan' => Zend_Translate::LOCALE_DIRECTORY
	));

	Zend_Validate_Abstract::setDefaultTranslator($translate);

	}

	protected function _initPlaceholders()
	{
		$this->bootstrap('View');
		$view = $this->getResource('View');
		$view->doctype('HTML5');

		// Feuilles de style
		$view->headLink()->prependStylesheet('/css/global.css');
		$view->headLink()->prependStylesheet('/css/bmin.css')
		->headLink(array('rel' => 'shortcut icon',
		                                    'href' => '/images/using/favicon.ico'),
		                          	    'PREPEND');

		// Fichiers jQuery
		$view->headScript()->prependFile('/js/bootstrap-tab.js');	
		$view->headScript()->prependFile('/js/bootstrap-carousel.js');
		$view->headScript()->prependFile('/js/bootstrap-dropdown.js');
		$view->headScript()->prependFile('/js/jquery-1.7.1.min.js');

	}
}

