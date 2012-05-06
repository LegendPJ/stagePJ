<?php

/**
 * En dérivant cette classe et en assignant un texte formaté dans les variable preotected $_subjectTemplate
 * et $_messageTemplate, il est possible d'assigner des valeurs à remplacer dans le sujet et dans le corps 
 * du message. Cette classe est là pour la compatibilité avec les anciens scripts. 
 * 
 * Cette classe sera supprimée dans la version 0.2
 * 
 * @deprecated Préférez Webf_Mail et Webf_Mail_Layout
 */
abstract class Webf_Mail_Abstract extends Zend_Mail {
	
	/**
	 * Modèle du message
	 * @var String
	 */
	protected $_messageTemplate;
	
	/**
	 * Modèle du sujet
	 * @var String
	 */
	protected $_subjectTemplate;
	
	/**
	 * Variables de remplacements des templates
	 * @var array
	 */
	private $_replaceValues = array();
	
	/**
	 * @var Zend_Mail_Transport_Smtp
	 */
	private $_transporter = null;
	
	
	public function __construct() {
		parent::__construct();
		//$returnPath = Zend_Controller_Front::getInstance()->getParam('config')->mailFromSite;
	}
	
	/**
	 * Définit le transporteur SMTP à utiliser
	 */
	public function setSmtpTransporter(Als_Mail_Smtp_Interface $transporter) {
		$this->_transporter = $transporter;
	}
	
	/**
	 * Définit le transporteur SendMail à utiliser
	 */
	public function setSendMailTransporter(Zend_Mail_Transport_Sendmail $transporter) {
		$this->_transporter = $transporter;
	}
	
	/**
	 * @return Zend_Mail_Transport_Smtp|null
	 */
	public function getTransporter() {
		return $this->_transporter;
	}
	
	/**
	 * Effectue les remplacemets de variables dans les templates de message et de sujet
	 * et envoie le mail
	 * 
	 * @param Zend_Mail_Transport_Smtp $transporter
	 * @return Zend_Mail
	 */
	public function send($transporter=null) {
		$this->setBodyHtml( $this->_escape($this->_replaceValues($this->_messageTemplate)) );
		$this->setSubject( $this->_escape($this->_replaceValues($this->_subjectTemplate)) );
		
		if( $transporter !== null ) {
			return parent::send($transporter);
		}
		
		$transporter = $this->getTransporter();
		if( $transporter === null ) {
			$transporter = new Zend_Mail_Transport_Sendmail();
			Zend_Mail::setDefaultTransport($transporter);
			return parent::send($this->getTransporter());
		}
				
		return parent::send($transporter);
	}
	
	/**
	 * Remplace les valeurs des variables de templates dans les templates
	 * 
	 * @param $template le template dans lequel remplacer les variables
	 * @return Als_Mail_ConfirmationInscription
	 */
	private function _replaceValues($template) {
		return
			str_replace(
				array_keys($this->_replaceValues),
				$this->_replaceValues,
				$template
			)
		;
	}
	
	/**
	 * Définit d'un seul coup toutes les valeurs des variables de remplacement
	 * 
	 * @param Array $vars
	 * @return Als_Mail_ConfirmationInscription
	 */
	public function assign(Array $vars) {
		foreach( $vars as $key => $value ) {
			$this->$key = $value;
		}
		return $this;
	}
	
	/**
	 * Echappe la chaîne $str
	 * 
	 * @param $str chaîne à échapper
	 * @return String La chaîne échappée
	 */
	protected function _escape($str) {
		return utf8_decode($str);
	}
	
	/**
	 * Définit les valeurs des variables de remplacement du sujet et du message
	 */
	public function __set($name, $value) {
		$this->_replaceValues["%".$name."%"] = $value;
	}
	
	/**
	 * Retourne le sujet et le message
	 */
	public function __toString() {
		$this->setBodyHtml( $this->_escape( $this->_replaceValues($this->_messageTemplate) ) );
		$this->setSubject( $this->_escape($this->_replaceValues($this->_subjectTemplate)) );
		
		return
			$this->getSubject() ."<br><br>".
			utf8_encode(quoted_printable_decode($this->getBodyHtml(true)));
		;
	}

}









