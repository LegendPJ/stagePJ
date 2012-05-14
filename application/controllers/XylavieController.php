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
		$this->view->else 		=   	Encadre::findEncadreNFNR($this->view->en[0]->id);
		$this->view->rbt 		=   	Encadre::findEncadreRbt($this->view->en[0]->id);
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
				$this->view->infos = $this->getRequest()->getParams();
				$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				$this->view->dateJour = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
				$this->view->adresse = $this->view->infos['adresse'].'<br>'. $this->view->infos['codeP'].' '.$this->view->infos['ville'];
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
                    			$layoutMailC->setScriptHtml("confirmDevisDep");
                    			$layoutMail->setScriptHtml("devisdep");
                    			$layoutMail->assign( array(
					"dateJour" => $this->view->dateJour,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civilite'],
					"nom" => $this->view->infos['nom'],
					"prenom" => $this->view->infos['prenom'],
					"date" => $this->view->infos['dateN'],
					"conjoint" => $this->view->infos['conjoint'],
					"civC" => $this->view->infos['civC'],
					"nomC" => $this->view->infos['nomC'],
					"prenomC" => $this->view->infos['prenomC'],
					"dateC" => $this->view->infos['dateC'],
					"adresse" => $this->view->adresse,
					"mail" => $this->view->infos['email'],
					"tel" => $this->view->infos['telephone'],
					"rente" => $this->view->infos['rente'],
					"depT" => $this->view->infos['depT'],
					"depTP" => $this->view->infos['depTP']
					));

                    			$layoutMailC->assign( array(
					"date" => $date,
					"controller" => strtoupper($this->view->controller)
					));
                    			$mail = new Webf_Mail($layoutMail);
                    			$mailC = new Webf_Mail($layoutMailC);
                    			// $sendGridTransporter = new Webf_Mail_Smtp_SendGrid('legendpj','legendpj');
				// $mail->setSmtpTransporter($sendGridTransporter);
                    			$mail->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Dépendance');
                    			$mailC->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Dépendance');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE');
				$mailC->addTo('pierrejulien.martinez@gmail.com');
				$mail->setSubject('Demande de Devis Dependance');
				$mailC->setSubject('Demande de Devis Dependance');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de devis envoyée correctement à la société '.strtoupper($this->view->controller).'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
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
        	
        	public function prevoyanceAction()
        	{
        		$this->view->form = new App_forms_prevoyance();
        		if ($this->getRequest()->isPost()) {

			if($this->view->form->isValid($this->getRequest()->getParams())) {
				
			}
		}
        	}
	public function contactAction()
	{
		$this->view->form = new App_forms_contact();	
		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
                            		$this->view->infos = $this->getRequest()->getParams();
                    			$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				$date = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
                    			$layoutMailC->setScriptHtml("confirmcontact");
                    			$layoutMail->setScriptHtml("contact");
                    			$layoutMail->assign( array(
					"date" => $date,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civilite'],
					"nom" => $this->view->infos['nom'],
					"message" => $this->view->infos['message'],
					"mail" => $this->view->infos['email'],
					"tel" => $this->view->infos['telephone']
					));

                    			$layoutMailC->assign( array(
					"date" => $date,
					"controller" => strtoupper($this->view->controller)
					));
                    			$mail = new Webf_Mail($layoutMail);
                    			$mailC = new Webf_Mail($layoutMailC);
                    			// $sendGridTransporter = new Webf_Mail_Smtp_SendGrid('legendpj','legendpj');
				// $mail->setSmtpTransporter($sendGridTransporter);
                    			$mail->setFrom('noreply@xylavie.fr', 'XYLAVIE - Service Contact');
                    			$mailC->setFrom('noreply@xylavie.fr', 'XYLAVIE - Service Contact');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE');
				$mailC->addTo('pierrejulien.martinez@gmail.com');
				$mail->setSubject('Contact XYLAVIE');
				$mailC->setSubject('Contact XYLAVIE');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de devis envoyée correctement à la société '.strtoupper($this->view->controller).'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
				$this->_helper->Redirector->gotoUrl('/xylavie/');
			} else {	
				$this->_helper->FlashMessenger('Le Formulaire comporte des erreurs')->setNamespace('error');
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}

	public function devisaccidentsdelavieAction()
	{
		$this->view->form = new App_forms_accident();
		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				$this->view->infos = $this->getRequest()->getParams();
				//MAIL + Recap
				$this->_forward('souscription', $this->view->controller, null, array('infos'=> $this->view->infos));
			}
		}
	}

	public function souscriptionAction() 
	{
		$this->view->infos = $this->_getParam('infos');
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
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		// Encadre::delete();
		$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Titre supprimé!');
		$this->_redirect('/xylavie/modif');
	}
}

?>

