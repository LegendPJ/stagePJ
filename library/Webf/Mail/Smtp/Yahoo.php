<?php

/**
 * Ne fonctionne pas!
 */
class Webf_Mail_Smtp_Yahoo implements Webf_Mail_Smtp_Interface
{
	
	private $_login;
	
	private $_password;
	
	/**
	 * Construit le transporteur en initialisant le login et le mot de passe
	 * 
	 * @param string $login
	 * @param string $password
	 */
	public function __construct($login=null, $password=null) {
		if( $login !== null ) {
			$this->setLogin($login);
		}
		
		if( $password !== null ) {
			$this->setPassword($password);
		}
	}
	
	public function getTransporter() {
		$config = array(
			'auth'		=> 'login',
			'username'	=> $this->_login,
			'password'	=> $this->_password,
			'ssl' 		=> 'tls',
			'port'		=> '465'
		);
		
		return new Zend_Mail_Transport_Smtp('smtp.mail.yahoo.fr', $config);
	}
	
	public function setPassword($password) {
		$this->_password = $password;
	}
	
	public function setLogin($login) {
		$this->_login = $login;
	}
}













