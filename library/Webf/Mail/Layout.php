<?php

class Webf_Mail_Layout
{
	/**
	 * @var Zend_Layout
	 */
	protected $_layout;
	
	/**
	 * @var Zend_View
	 */
	protected $_view;
	
	/**
	 * Chemin vers le script de vue du layout
	 */
	protected $_path;
	
	/**
	 * Script de layout
	 */
	protected $_layoutScript;
	
	/**
	 * Script de rendu de la vue
	 */
	protected $_scriptHtml;
	
	/**
	 * Contenu HTML du mail
	 */
	private $_html;
	
	
	public function __construct($path = null, $layoutScript = null)
	{
		if( $path == null ) {
			$viewScriptPath = Zend_Layout::getMvcInstance()->getViewScriptPath();
			$path = dirname($viewScriptPath)."/mails";
		}
		
		$this->_path = $path;
		$this->_layout = new Zend_Layout();
		$this->_layout->setLayoutPath($this->_path);
		
		if( $layoutScript != null ) {
			$this->_layoutScript = $layoutScript;
		}
		
		$this->_view = new Zend_View();
		$this->_view->setBasePath($this->_path);
	}
	
	/**
	 * Définit le script de layout à utiliser
	 *
	 * @param string $layoutScript
	 * @return Webf_MailLayout
	 */
	public function setLayoutScript($layoutScript)
	{
		$this->_layoutScript = $layoutScript;
		return $this;
	}
	
	/**
	 * Définit le script 
	 *
	 * @param string $script
	 * @param string $layoutScript
	 * @return Webf_Mail_Layout
	 */
	public function setScriptHtml($script)
	{
		$this->_scriptHtml = $script;
		return $this;
	}
	
	/**
	 * @return Zend_Layout
	 */
	public function getLayout()
	{
		return $this->_layout;
	}
	
	/**
	 * Rend le layout de mail
	 *
	 * @return string
	 */
	public function render()
	{
		if( $this->_layoutScript == null ) {
			throw new Exception("Aucun script de layout configuré");
		}
		
		if( $this->_scriptHtml == null ) {
			throw new Exception("Aucun script de rendu configuré");
		}
		
		$content = $this->_view->render($this->_scriptHtml.".".Zend_Layout::getMvcInstance()->getViewSuffix());
		
		$this->_layout->setLayout($this->_layoutScript);
		$this->_layout->content = $content;
		$body = $this->_layout->render();
		
		$this->_html = $body;
		return $this->_html;
	}
	
	/**
	 * Définit les variable de vue
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function __set($name,$value)
	{
		if( '_' != substr($name, 0, 1) ) {  
			$this->_view->$name = $value;
		}
	}
	
	/**
	 * Définit d'un seul coup toutes les variables de vue si $vars est un tableau.
	 * Si $varsest une chaîne, $valeu doit être spécifiée
	 * 
	 * @param string|array $vars
	 * @param mixed $value
	 * @return Webf_Mail_Layout
	 */
	public function assign($vars,$value=null) {
		if( is_array($vars) ) {
			foreach( $vars as $key => $value ) {
				$this->$key = $value;
			}
		} elseif( is_string($vars) ) {
			$this->$vars = $value;
		}
		return $this;
	}
	
	/**
	 * Retourne le code HTML du mail
	 *
	 * @return string
	 */
	public function getHtml() {
		if( !$this->_html ) {
			$this->_html = $this->render();
		}
		
		return $this->_html;
	}
}

















