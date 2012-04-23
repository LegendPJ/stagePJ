<?php
 
/**
 * @see Zend_Controller_Action_Helper_FlashMessenger
 */
require_once 'Zend/Controller/Action/Helper/FlashMessenger.php';
 
/**
 * @author grummfy
 */
class Zend_View_Helper_FlashMessenger extends Zend_View_Helper_Abstract implements IteratorAggregate, Countable
{
	protected $_fm;
 
	public function __construct()
	{
		$this->_fm = new Zend_Controller_Action_Helper_FlashMessenger();
	}
 
	public function flashMessenger($cur = false)
	{
		if ($cur)
			return $this;
		else
			return $this->getMessages();
	}
 
	/**
	 * Return currents FlashMessegenr object
	 * @return Zend_Controller_Action_Helper_FlashMessenger
	 */
	public function getFlasMessenger()
	{
		return $this->_fm;
	}
 
	/**
	 * Return previous emmited messages
	 * @return array
	 */
	public function getMessages()
	{
		return $this->_fm->getMessages();
	}
 
	/**
	 * Renvoi le nombre de messages passé
	 * @return int
	 */
	public function hasMessages()
	{
		return count($this->_fm);		
	}
 
	public function getIterator()
	{
		return $this->_fm->getIterator();
	}
 
	public function count()
	{
		return $this->_fm->count();
	}
}
 
# EOF