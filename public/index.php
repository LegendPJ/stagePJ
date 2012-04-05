<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));


//DOCTRINE
// require(dirname(__FILE__).'/../config/global.php');

// // Si elle existe, supprimez la base existante.
// // Attention, cela vide totalement la base de données !
// Doctrine_Core::dropDatabases();

// // Création de la base (uniquement si elle n'EXISTE PAS)
// Doctrine_Core::createDatabases();

// // Création des fichiers de modèle à partir du schema.yml
// // Si vous n'utilisez pas le Yaml, n'exécutez pas cette ligne !
// Doctrine_Core::generateModelsFromYaml(CFG_DIR.'schema.yml', LIB_DIR.'models', array('generateTableClasses' => true));

// // Création des tables
// Doctrine_Core::createTablesFromModels(LIB_DIR.'models');




/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();