<?php

class Webf_Mail extends Zend_Mail {
	
	/**
	 * @var Webf_Mail_Layout
	 */
	private $_layoutMail;
	
	/**
	 * @var Zend_Mail_Transport_Smtp
	 */
	private $_transporter = null;
	
	
	public function __construct($mailLayout = null) {
		parent::__construct();
		if( $mailLayout != null ) {
			$this->setLayoutMail($mailLayout);
		}
	}
	
	/**
	 * Définit le template de mail à utiliser
	 */
	public function setLayoutMail(Webf_Mail_Layout $mailLayout) {
		$this->_layoutMail = $mailLayout;
	}
	
	/**
	 * Définit le transporteur SMTP à utiliser
	 */
	public function setSmtpTransporter(Webf_Mail_Smtp_Interface $transporter) {
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
		if( $this->_transporter instanceof Webf_Mail_Smtp_Interface ) {
			return $this->_transporter->getTransporter();
		}
		
		return $this->_transporter;
	}
	
	/**
	 * envoie le mail
	 * 
	 * @param Zend_Mail_Transport_Smtp $transporter
	 * @return Zend_Mail
	 */
	public function send($transporter=null) {
		if( !$this->getBodyHtml() ) {
			$this->setBodyHtml( $this->_escape($this->_layoutMail->getHtml()) );
		}
		
		if( $transporter !== null ) {
			if( $transporter instanceof Webf_Mail_Smtp_Interface ) {
				$transporter = $transporter->getTransporter();
			}
			
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
	 * Définit d'un seul coup toutes les valeurs des variables de remplacement
	 * 
	 * @param Array $vars
	 * @return Webf_Mail_ConfirmationInscription
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
		return iconv("utf-8","cp1252//TRANSLIT",$str);
	}
	
	/**
	 * Définit le sujet du mail
	 *
	 * @param $subject
	 * @return Webf_Mail
	 */
	public function setSubject($subject) {
		parent::setSubject($this->_escape($subject));
	}
	
	/**
	 * Retourne le sujet et le message
	 */
	public function __toString() {
		return $this->toString(false);
	}
	
	/**
	 * Retourne le contenu du mail
	 */
	public function toString($subject=false)
	{
		if( !$this->getBodyHtml() ) {
			$this->setBodyHtml( $this->_escape($this->_layoutMail->getHtml()) );
		}
		
		return
			($subject == true ? $this->getSubject() ."<br><br>" : "").
			utf8_encode(quoted_printable_decode($this->getBodyHtml(true)));
		;
	}
}









