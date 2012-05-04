<?php

class XylassurController extends Zend_Controller_Action
{

	public function init()
	{
	}

	public function indexAction()
	{
		$this->view->en 		= 	Entite::findEntity(strtoupper($this->view->controller));
		$this->view->encEnti		= 	Encadre::findEncadreEntite($this->view->en[0]->id); 
								//on récupère les encadre relatifs à l'entité (XYLASSUR)
	}

	public function contactAction()
	{
		$this->view->form = new App_forms_contact();
		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
                    			$this->view->civilite = $this->view->form->getCivilite();
                    			$this->view->nom = $this->view->form->getNom();
                    			$this->view->email = $this->view->form->getEmail();
                    			$this->view->telephone = $this->view->form->getTelephone();
                    			$this->view->message = $this->view->form->getMessage();
                    			
                    			$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				$date = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
				//MAIL
				$html = new Zend_View();
				$html->setScriptPath(APPLICATION_PATH . '/views/emails/');

				$html->assign('date', $date);
				$html->assign('controller', strtoupper($this->view->controller));
				$html->assign('civilite', $this->view->civilite);
				$html->assign('nom', $this->view->nom);
				$html->assign('message', $this->view->message);
				$html->assign('mail', $this->view->mail);
				$html->assign('tel', $this->view->telephone);

				$mail = new Zend_Mail('utf-8');

				$bodyText = $html->render('contact.phtml');
				// $mailT = new Zend_Mail_Transport_Sendmail();
				// $mail->send($mailT);
				$mail->setFrom('noreply@xylassur.fr', 'Contact - XYLASSUR')
					->addTo('pierrejulien.martinez@gmail.com', 'XYLASSUR')
					->setBodyHtml($bodyText)
					->setSubject('Mail de contact - XYLASSUR')
					->send();
				// $mailT = new Zend_Mail_Transport_Sendmail();
				// $mail = new Zend_Mail();
				// $contenu = '<span style="font-weight:bold">Bonjour, <br><br>En date du '.$date.' la société '.strtoupper($this->view->controller).' a reçu un message de la part de '.$this->view->civilite.' '.$this->view->nom.'</span><br><br>'.$this->view->message.'<br>Ses coordonnées sont les suivantes : <br>Email : '.$this->view->email.'<br>Tel : '.$this->view->telephone.'<br><br>Bonne journée';
				// $mail->setFrom('noreply@xylassur.fr', 'Contact - XYLASSUR')
				// 	->addTo('info@xylassur.fr', 'XYLASSUR')
				// 	->setBodyHtml($contenu, 'UTF-8')
				// 	->setSubject('Sujet de test')
				// 	->send($mailT);
				$this->_helper->Redirector->gotoUrl('/xylassur/');
			}
			else {
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}

	public function modifAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$this->_helper->layout->setLayout('layoutstart');
		$this->view->enti 		= 	Entite::findEntity(strtoupper($this->view->controller));
		$this->view->grandtitre	= 	Encadre::findEncadreEntite($this->view->enti[0]->id); 
	}
}

?>

