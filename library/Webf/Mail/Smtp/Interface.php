<?php

interface Webf_Mail_Smtp_Interface {
	
	/**
	 * Retourne le transporteur
	 * 
	 * @return Zend_Mail_Transport_Smtp
	 */
	public function getTransporter();
	
	/**
	 * Définit le login à utiliser pour la connexion SMTP
	 * 
	 * @param String $login
	 */
	public function setLogin($login);
	
	/**
	 * Définit le mot de passe à utiliser pour la connexion SMTP
	 * 
	 * @param String $password
	 */
	public function setPassword($password);
	
}

?>