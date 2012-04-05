<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
date_default_timezone_set('Europe/Brussels');

/*
* Setup libraries & autoloaders
*/
set_include_path(dirname(__FILE__).'/../library/zendframework'
. PATH_SEPARATOR . dirname(__FILE__).'/../library/doctrine'. PATH_SEPARATOR . dirname(__FILE__).'/../library/doctrine/Doctrine'
. PATH_SEPARATOR . dirname(__FILE__).'/models'
. PATH_SEPARATOR . dirname(__FILE__).'/models/generated'
. PATH_SEPARATOR . get_include_path());
// require 'Zend/Loader.php';
// Zend_Loader::registerAutoload(‘Zend_Loader’);

/*
* Set super-global data
*/
Doctrine_Manager::connection("mysql://user:pass@localhost/database");

/*
* Configure Doctrine
*/
Zend_Registry::set('doctrine_config', array(
'data_fixtures_path' => dirname(__FILE__).'/doctrine/data/fixtures',
'models_path' => dirname(__FILE__).'/models',
'migrations_path' => dirname(__FILE__).'/doctrine/migrations',
'sql_path' => dirname(__FILE__).'/doctrine/data/sql',
'yaml_schema_path' => dirname(__FILE__).'/doctrine/schema'
));