<?php

class ErrorController extends Zend_Controller_Action
{
	public function errorAction()
	{
		$this->view->article = Article::getUnArticle();
		$this->view->today  = Zend_Date::now();
	}
}

