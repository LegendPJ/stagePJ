<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{

	}

	public function indexAction()
	{
		$entiteAccueil 			= 	Entite::findAccueil(); //on recupere la ligne d'ACCUEIL
		$this->view->encadreAccueil 	= 	Encadre::findEncadreEntite($entiteAccueil[0]->id); //on récupère les encadre relatifs à ACCUEIL
		$this->view->last 		= 	News::findLastNews(); //on récupère la denière news

		// $mailT = new Zend_Mail_Transport_Sendmail();
		// $mail = new Zend_Mail();
		// $mail->addTo('pierrejulien.martine@gmail.com', 'PJ')
		// 	->setFrom('pierrejulien.martine@gmail.com', 'pj')
		// 	->setSubject('Salut PJ')
		// 	->setBodyText('Email Body')
		// 	->send($mailT);

		// $mail = new Zend_Mail();
		// $mail->setBodyText('Ceci est le texte du message.')
		// 	->setFrom('pierrejulien.martinez@live.fr', 'Expéditeur')
		// 	->addTo('pierrejulien.martinez@gmail.com', 'Destinataire')
		// 	->setSubject('Sujet de test')
		// 	->send();
	// 	$tr = new Zend_Mail_Transport_Smtp('localhost');
 //    				Zend_Mail::setDefaultTransport($tr);
	// 	$mail = new Zend_Mail();
	// 	$mail->setBodyText('Mon texte de test');
	// 	$mail->setBodyHtml('Mon texte de test');
	// 	$mail->setFrom('pierrejulien.martinez@live.fr', 'Expéditeur');
	// 	$mail->addTo('pierrejulien.martinez@gmail.com', 'Destinataire');
	// 	$mail->setSubject('Sujet de test');
	// 	$mail->send();
	}

}	