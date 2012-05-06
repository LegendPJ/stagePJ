<?php

// include_once 'Swift/swift_required.php';
// include_once 'SmtpApiHeader.php';

class Manager_Mail
{
	/**
	 * @var Webf_Mail_Layout
	 */
	private $_layoutMail;
	
	/**
	 * @var Webf_Mail
	 */
	private $_mail;
	
	/**
	 * @var Swift_Mailer
	 */
	private $swift;
	
	/**
	 * @param string $email
	 */
	public function sendEmail($dest, $mail, $nom)
	{
		$this->initMail($mail, $nom);
		
		$this->_layoutMail->setScriptHtml("contact");
		
		// $config = Zend_Controller_Front::getInstance()->getParam('config');
		// $webfEncrypt = new Webf_Crypt_MCrypt($config->mail_confirmation->key,$config->mail_confirmation->iv);
		
		// $this->_layoutMail->code = $webfEncrypt->urlcrypt($email);
		// $this->_layoutMail->urlSite = $config->urlSite;
		$this->_mail->addTo($dest);
		
		$this->_mail->setSubject("Email de contact");
		
		// echo $this->_mail->toString(); exit;
		$this->_mail->send();
	}
	
	/**
	 * @param Personne $personne
	 */
	public function sendConfirmationInscription($personne)
	{
		$this->initMail();
		
		$this->_layoutMail->setScriptHtml("confirmation-inscription");
		$this->_layoutMail->personne = $personne;
		
		$this->_mail->addTo($personne->_getEmail());
		$this->_mail->setSubject("Ton droit de vote est arrivé - Concours du Pire CV Video");
		
		//echo $this->_mail->toString(); exit;
		$this->_mail->send();
	}

	public function initMail($mail, $nom)
	{
		$this->_layoutMail = new Webf_Mail_Layout(APPLICATION_PATH."/layouts/mails","main");
		$this->_mail = new Webf_Mail($this->_layoutMail);
		
		// $config = Zend_Controller_Front::getInstance()->getParam('config');
		
		$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('legendpj','legendpj');
		$this->_mail->setSmtpTransporter($sendGridTransporter);
		
		$this->_mail->setFrom($mail, $nom);
	}
	
	public function initSwiftSendGrid()
	{
		$this->_layoutMail = new Webf_Mail_Layout(APPLICATION_PATH."/layouts/mails","main");
		$this->_mail = new Webf_Mail($this->_layoutMail);
		
		$transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net',587);
		$transport->setUsername('legendpj');
		$transport->setPassword('legendpj');
		
		$this->swift = Swift_Mailer::newInstance($transport);
	}
	
	
	
}