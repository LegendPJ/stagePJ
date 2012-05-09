<?php

class XylavieController extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
	}

	public function indexAction()
	{
		$this->view->en 		= 	Entite::findEntity(strtoupper($this->view->controller));
		$this->view->first		=	Encadre::findFirstEncadreEntite($this->view->en[0]->id);
		$this->view->else		= 	Encadre::findEncadreEntiteNoFirst($this->view->en[0]->id);
								//on récupère les encadre relatifs à l'entité (XYLAVIE)
	}

	public function devissanteAction()
	{
            	$this->view->form = new App_forms_sante();
            	if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				$this->view->civilite = $this->view->form->getCivilite();
			}
		}

	}

	public function devisdependanceAction()
	{
            	$this->view->form = new App_forms_dependance();
            	if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				$this->view->dateJour = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");

				$this->view->civilite = $this->view->form->getCivilite();
                    			$this->view->nom = $this->view->form->getNom();
                    			$this->view->prenom = $this->view->form->getPrenom();
                    			$this->view->date = $this->view->form->getDate();
                    			$this->view->conjoint = $this->view->form->getConjoint();
                    			if ($this->view->conjoint == "Oui") {
                    				$this->view->civC = $this->view->form->getCivC();
                    				$this->view->nomC = $this->view->form->getNomC();
                    				$this->view->prenomC = $this->view->form->getPrenomC();
                    				$this->view->dateC = $this->view->form->getDateC();
                    			}
                    			$this->view->adresse = $this->view->form->getAdresse().'<br>'. $this->view->form->getCodeP().' '.$this->view->form->getVille();
                    			$this->view->mail  =  $this->view->form->getMail();
                    			$this->view->tel  =  $this->view->form->getTel();
                    			$this->view->rente  =  $this->view->form->getRente();
                    			$this->view->depT  =  $this->view->form->getDepT();
                    			$this->view->depTP  =  $this->view->form->getDepTP();
				//MAIL
				// $html = new Zend_View();
				// $html->setScriptPath(APPLICATION_PATH . '/views/emails/');

				// $html->assign('dateJour', $this->view->dateJour);
				// $html->assign('controller', strtoupper($this->view->controller));
				// $html->assign('civilite', $this->view->civilite);
				// $html->assign('nom', $this->view->nom);
				// $html->assign('prenom', $this->view->prenom);
				// $html->assign('date', $this->view->date);
				// $html->assign('conjoint', $this->view->conjoint);
				// $html->assign('civC', $this->view->civC);
				// $html->assign('nomC', $this->view->nomC);
				// $html->assign('prenomC', $this->view->prenomC);
				// $html->assign('dateC', $this->view->dateC);
				// $html->assign('adresse', $this->view->adresse);
				// $html->assign('mail', $this->view->mail);
				// $html->assign('tel', $this->view->tel);
				// $html->assign('rente', $this->view->rente);
				// $html->assign('depT', $this->view->depT);
				// $html->assign('depTP', $this->view->depTP);

				// $mail = new Zend_Mail('utf-8');

				// $bodyText = $html->render('devisdep.phtml');
				// // $mailT = new Zend_Mail_Transport_Sendmail();
				// // $mail->send($mailT);
				// $mail->setFrom('noreply@xylavie.fr', 'Demande de Devis - XYLAVIE')
				// 	->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE')
				// 	->setBodyHtml($bodyText)
				// 	->setSubject('Demande de Devis')
				// 	->send();
                    			$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
                    			$layoutMail->setScriptHtml("contact");
                    			$mail = new Webf_Mail($layoutMail);
                    			$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('wizbii','wizbii38');
				$mail->setSmtpTransporter($sendGridTransporter);
                    			$mail->setFrom('noreply@xylavie.fr', 'Demande de Devis - XYLAVIE');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE');
				// ->setBodyHtml($bodyText)
				$mail->setSubject('Demande de Devis');
				$mail->send();
				//FIN MAIL
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de devis envoyée correctement à la société'.$this->controller.'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
				$this->_helper->Redirector->gotoUrl('/xylavie/');
			} else {	
				$this->_helper->FlashMessenger('Le formulaire comporte des erreurs')->setNamespace('error');
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}
        	
        	public function devisretraiteAction()
        	{
        		$this->view->form = new App_forms_retraitepargne();
        		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				$this->view->civilite = $this->view->form->getCivilite();
                    			$this->view->nom = $this->view->form->getNom();
                    			$this->view->prenom = $this->view->form->getPrenom();
                    			$this->view->options = $this->view->form->getProjets();
                    			//TESTS
			}
		}
        	}

        	public function devisepargneAction()
        	{
        		$this->view->form = new App_forms_retraitepargne();
        		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				$this->view->civilite = $this->view->form->getCivilite();
                    			$this->view->nom = $this->view->form->getNom();
                    			$this->view->prenom = $this->view->form->getPrenom();
                    			$this->view->options = $this->view->form->getProjets();
                    			//TESTS
			}
		}
        	}

        	public function devisassuranceemprunteurAction()
        	{
        		$this->view->form = new App_forms_emprunt();
        		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				$this->view->civilite = $this->view->form->getCivilite();
                    			$this->view->nom = $this->view->form->getNom();
                    			$this->view->prenom = $this->view->form->getPrenom();
                    			//TESTS + TEST CAPTCHA
			}
		}
        	}
        	
	public function contactAction()
	{
		$this->view->form = new App_forms_contact();	
		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
                    			$this->view->civilite = $this->view->form->getCivilite();
                    			$this->view->nom = $this->view->form->getNom();
                    			$this->view->mail = $this->view->form->getEmail();
                    			$this->view->tel = $this->view->form->getTelephone();
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
				$html->assign('tel', $this->view->tel);

				$mail = new Zend_Mail('utf-8');

				$bodyText = $html->render('contact.phtml');
				// $mailT = new Zend_Mail_Transport_Sendmail();
				// $mail->send($mailT);
				$mail->setFrom('noreply@xylavie.fr', 'Contact - XYLAVIE')
					->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE')
					->setBodyHtml($bodyText)
					->setSubject('Mail de contact XYLAVIE')
					->send();
				//FIN MAIL
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Message envoyé correctement à la société'.$this->controller.'.');
				$this->_helper->Redirector->gotoUrl('/xylavie/');
			} else {	
				$this->_helper->FlashMessenger('Le Formulaire comporte des erreurs')->setNamespace('error');
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}

	public function modifAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$this->_helper->layout->setLayout('layoutstart');
		$this->view->en 		= 	Entite::findEntity(strtoupper($this->view->controller));
		$this->view->encadres	=	Encadre::findEncadreEntite($this->view->en[0]->id);

		$query = $this->getRequest();
		$errors = array();
		if($query->isPost()) {
			$titre = $query->getParam('titre');
			$id = $query->getParam('id');
			$notEmptyValidator = new Zend_Validate_NotEmpty();
			if(!$notEmptyValidator->isValid($titre)) {
				$errors[] = "Le titre ne peut être vide !";
			}
			if( count($errors) ) {
				$fm = $this->_helper->flashMessenger->addMessage($errors);
			} else {
				Encadre::updateTEncadre($titre, $id);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Titre modifié avec succès!');
				$this->_redirect('/xylavie/modif');
			}
		}
	}

	public function suppAction()
	{
		// Encadre::delete();
		$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Titre supprimé!');
		$this->_redirect('/xylavie/modif');
	}
}

?>

