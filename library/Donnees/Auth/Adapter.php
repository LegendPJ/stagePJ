<?php

class Donnees_Auth_Adapter implements Zend_Auth_Adapter_Interface
{
	const NON_TROUVE_MESSAGE = "Compte non trouvé";
	const MAUVAIS_PASS_MESSAGE = "Le mot de passe est incorrect";

	/**
	*
	* @var Users
	*/
	protected $user;

	/**
	*
	* @var string
	*/
	protected $username;

	/**
	*
	* @var string
	*/
	protected $password;

	public function __construct($username , $password)
	{
		$this->username = $username;
		$this->password = $password;
	}

	public function authenticate()
	{
		try
		{
			$this->user = Users::authenticate($this->username, $this->password);
		} catch (Exception $e) {
			if ($e->getMessage() == Users::MAUVAIS_PASS)
				return $this->result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, self::MAUVAIS_PASS_MESSAGE);
			if ($e->getMessage() == Users::PAS_TROUVE)
				return $this->result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, self::NON_TROUVE_MESSAGE);
		}
		return $this->result(Zend_Auth_Result::SUCCESS);
	}

	public function result($code, $messages = array()) 
	{
		if (!is_array($messages)) {
			$messages = array($messages);
		}
		return new Zend_Auth_Result(
					$code,
					$this->user,
					$messages
					);
	}
}

