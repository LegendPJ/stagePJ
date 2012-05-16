<?php

class XylavieController extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
	}

	public function indexAction()
	{
		$this->view->en 	= 	Entite::findEntity(strtoupper($this->view->controller));
		$this->view->first 	= 	Encadre::findFirstEncadreEntite($this->view->en[0]->id);
		$this->view->else 	= 	Encadre::findEncadreNFNR($this->view->en[0]->id);
		$this->view->rbt 	= 	Encadre::findEncadreRbt($this->view->en[0]->id);
	}

	public function devissanteAction()
	{
		$this->view->form = new App_forms_sante();
		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				$this->view->infos = $this->getRequest()->getParams();
				$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				$this->view->dateJour = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
				$this->view->adresse = $this->view->infos['adresse'].'<br>'. $this->view->infos['codeP'].' '.$this->view->infos['ville'];
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisSan");
				$layoutMail->setScriptHtml("devissan");
				$layoutMail->assign( array(
				"dateJour" => $this->view->dateJour,
				"controller" => strtoupper($this->view->controller),
				"civilite" => $this->view->infos['civ'],
				"nom" => $this->view->infos['nom'],
				"prenom" => $this->view->infos['prenom'],
				"date" => $this->view->infos['dateN'],
				"conjoint" => $this->view->infos['conjoint'],
				"dateC" => $this->view->infos['dateNC'],
				"nbenfant" => $this->view->infos['nbenfant'],
				"date1" => $this->view->infos['date1'],
				"date2" => $this->view->infos['date2'],
				"date3" => $this->view->infos['date3'],
				"adresse" => $this->view->adresse,
				"mail" => $this->view->infos['email'],
				"tel" => $this->view->infos['telephone'],
				"q1" => $this->view->infos['q1'],
				"q2" => $this->view->infos['q2'],
				"q3" => $this->view->infos['q3']
				));

				if (count($this->infos["q4"]) != 0)
					$layoutMail->assign(array("q4" => $this->view->infos['q4']));

				$layoutMailC->assign( array(
					"date" => $this->view->dateJour,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom']
				));
				$mail = new Webf_Mail($layoutMail);
				$mailC = new Webf_Mail($layoutMailC);
				$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('xylagroup','xylagroup2012');
				$mail->setSmtpTransporter($sendGridTransporter);
				$mailC->setSmtpTransporter($sendGridTransporter);
				$mail->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Sante');
				$mailC->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Sante');
				// $mail->addTo('eberard@xylavie.fr', 'XYLAVIE');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE');
				$mailC->addTo('pierrejulien.martinez@gmail.com');
				$mail->setSubject('Demande de Devis Sante');
				$mailC->setSubject('Demande de Devis Sante');
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
				"civilite" => $this->view->infos['civ'],
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
					"date" => $this->view->dateJour,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom']
				));
				$mail = new Webf_Mail($layoutMail);
				$mailC = new Webf_Mail($layoutMailC);
				$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('xylagroup','xylagroup2012');
				$mail->setSmtpTransporter($sendGridTransporter);
				$mailC->setSmtpTransporter($sendGridTransporter);
				$mail->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Dependance');
				$mailC->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Dependance');
				// $mail->addTo('eberard@xylavie.fr', 'XYLAVIE');
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
				$this->view->infos = $this->getRequest()->getParams();
				$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				$this->view->dateJour = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
				$this->view->adresse = $this->view->infos['adresse'].'<br>'. $this->view->infos['codeP'].' '.$this->view->infos['ville'];
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisRet");
				$layoutMail->setScriptHtml("devisret");
				$layoutMail->assign( array(
					"dateJour" => $this->view->dateJour,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom'],
					"prenom" => $this->view->infos['prenom'],
					"date" => $this->view->infos['dateN'],
					"adresse" => $this->view->adresse,
					"mail" => $this->view->infos['email'],
					"tel" => $this->view->infos['telephone'],
					"avenir" => $this->view->infos['avenir'],
					"projets" => $this->view->infos['projets']
					));

				$layoutMailC->assign( array(
					"date" => $this->view->dateJour,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom']
				));
				$mail = new Webf_Mail($layoutMail);
				$mailC = new Webf_Mail($layoutMailC);
				$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('xylagroup','xylagroup2012');
				$mail->setSmtpTransporter($sendGridTransporter);
				$mailC->setSmtpTransporter($sendGridTransporter);
				$mail->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Retraite');
				$mailC->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Retraite');
				// $mail->addTo('eberard@xylavie.fr', 'XYLAVIE');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE');
				$mailC->addTo('pierrejulien.martinez@gmail.com');
				$mail->setSubject('Demande de Devis Retraite');
				$mailC->setSubject('Demande de Devis Retraite');
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

	public function devisepargneAction()
	{
		$this->view->form = new App_forms_retraitepargne();
		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				$this->view->infos = $this->getRequest()->getParams();
				$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				$this->view->dateJour = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
				$this->view->adresse = $this->view->infos['adresse'].'<br>'. $this->view->infos['codeP'].' '.$this->view->infos['ville'];
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisEpa");
				$layoutMail->setScriptHtml("devisepa");
				$layoutMail->assign( array(
					"dateJour" => $this->view->dateJour,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom'],
					"prenom" => $this->view->infos['prenom'],
					"date" => $this->view->infos['dateN'],
					"adresse" => $this->view->adresse,
					"mail" => $this->view->infos['email'],
					"tel" => $this->view->infos['telephone'],
					"avenir" => $this->view->infos['avenir'],
					"projets" => $this->view->infos['projets']
					));

				$layoutMailC->assign( array(
					"date" => $this->view->dateJour,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom']
				));
				$mail = new Webf_Mail($layoutMail);
				$mailC = new Webf_Mail($layoutMailC);
				$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('xylagroup','xylagroup2012');
				$mail->setSmtpTransporter($sendGridTransporter);
				$mailC->setSmtpTransporter($sendGridTransporter);
				$mail->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Epargne');
				$mailC->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Epargne');
				// $mail->addTo('eberard@xylavie.fr', 'XYLAVIE');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE');
				$mailC->addTo('pierrejulien.martinez@gmail.com');
				$mail->setSubject('Demande de Devis Epargne');
				$mailC->setSubject('Demande de Devis Epargne');
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
				$this->view->infos = $this->getRequest()->getParams();
				$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				$this->view->dateJour = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisPre");
				$layoutMail->setScriptHtml("devispre");
				$layoutMail->assign( array(
					"dateJour" => $this->view->dateJour,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom'],
					"prenom" => $this->view->infos['prenom'],
					"mail" => $this->view->infos['email'],
					"tel" => $this->view->infos['telephone'],
					"statut" => $this->view->infos['statut'],
					"demande" => $this->view->infos['demande'],
					"message" => $this->view->infos['message']
					));

				$layoutMailC->assign( array(
					"date" => $this->view->dateJour,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom']
				));
				$mail = new Webf_Mail($layoutMail);
				$mailC = new Webf_Mail($layoutMailC);
				$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('xylagroup','xylagroup2012');
				$mail->setSmtpTransporter($sendGridTransporter);
				$mailC->setSmtpTransporter($sendGridTransporter);
				$mail->setFrom('noreply@xylavie.fr', 'XYLAVIE - Renseignements Prevoyance');
				$mailC->setFrom('noreply@xylavie.fr', 'XYLAVIE - Renseignements Prevoyance');
				// $mail->addTo('eberard@xylavie.fr', 'XYLAVIE');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE');
				$mailC->addTo('pierrejulien.martinez@gmail.com');
				$mail->setSubject('Demande de Renseignements Prevoyance');
				$mailC->setSubject('Demande de Renseignements Prevoyance');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de renseignements envoyée correctement à la société '.strtoupper($this->view->controller).'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
				$this->_helper->Redirector->gotoUrl('/xylavie/');
			} else {
				$this->_helper->FlashMessenger('Le formulaire comporte des erreurs')->setNamespace('error');
				$this->view->errorElements = $this->view->form->getMessages();
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
				$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('xylagroup','xylagroup2012');
				$mail->setSmtpTransporter($sendGridTransporter);
				$mail->setFrom('noreply@xylavie.fr', 'XYLAVIE - Service Contact');
				$mailC->setFrom('noreply@xylavie.fr', 'XYLAVIE - Service Contact');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE');
				$mailC->addTo('pierrejulien.martinez@gmail.com');
				$mail->setSubject('Contact XYLAVIE');
				$mailC->setSubject('Contact XYLAVIE');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de contact envoyée correctement à la société '.strtoupper($this->view->controller).'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
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
				$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				$this->view->dateJour = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisAcc");
				$layoutMail->setScriptHtml("devisacc");
				$layoutMail->assign( array(
					"dateJour" => $this->view->dateJour,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom'],
					"prenom" => $this->view->infos['prenom'],
					"date" => $this->view->infos['dateN'],
					"mail" => $this->view->infos['email'],
					"tel" => $this->view->infos['telephone'],
					"adresse" => $this->view->infos['adresse'],
					"codeP" => $this->view->infos['codeP'],
					"ville" => $this->view->infos['ville'],
					"contrat" => $this->view->infos['contrat'],
					"conjoint" => $this->view->infos['conjoint'],
					"nomC" => $this->view->infos['nomC'],
					"prenomC" => $this->view->infos['prenomC'],
					"dateC" => $this->view->infos['dateC'],
					"nombreenfant" => $this->view->infos['nombreenfant'],
					"nom1" => $this->view->infos['nom1'],
					"prenom1" => $this->view->infos['prenom1'],
					"date1" => $this->view->infos['date1'],
					"nom2" => $this->view->infos['nom2'],
					"prenom2" => $this->view->infos['prenom2'],
					"date2" => $this->view->infos['date2'],
					"nom3" => $this->view->infos['nom3'],
					"prenom3" => $this->view->infos['prenom3'],
					"date3" => $this->view->infos['date3'],
					"nom4" => $this->view->infos['nom4'],
					"prenom4" => $this->view->infos['prenom4'],
					"date4" => $this->view->infos['date4'],
					"nom5" => $this->view->infos['nom5'],
					"prenom5" => $this->view->infos['prenom5'],
					"date5" => $this->view->infos['date5'],
					"paiement" => $this->view->infos['hide'],
					"cg" => $this->view->infos['cg']
					));
				if (isset( $this->view->infos['civC']))
					$layoutMail->assign( array("civC" => $this->view->infos['civC']));
				
				$layoutMailC->assign( array(
					"date" => $this->view->dateJour,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom']
				));
				$mail = new Webf_Mail($layoutMail);
				$mailC = new Webf_Mail($layoutMailC);
				$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('xylagroup','xylagroup2012');
				$mail->setSmtpTransporter($sendGridTransporter);
				$mailC->setSmtpTransporter($sendGridTransporter);
				$mail->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis GAV ');
				$mailC->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis GAV ');
				// $mail->addTo('eberard@xylavie.fr', 'XYLAVIE');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE');
				$mailC->addTo('pierrejulien.martinez@gmail.com');
				$mail->setSubject('Demande de Devis Garanties Accidents de la Vie');
				$mailC->setSubject('Demande de Devis Garanties Accidents de la Vie');
				$mail->send();
				$mailC->send();
				// $this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de devis envoyée correctement à la société '.strtoupper($this->view->controller).'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
				$this->_forward('souscription', $this->view->controller, null, array('infos'=> $this->view->infos));
			} else {
				$this->_helper->FlashMessenger('Le formulaire comporte des erreurs')->setNamespace('error');
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}

	public function souscriptionAction()
	{
		$this->view->infos = $this->_getParam('infos');
		if (empty($this->view->infos))
			$this->_redirect('/error');
	}

	public function modifAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$this->_helper->layout->setLayout('layoutstart');
		$this->view->en = Entite::findEntity(strtoupper($this->view->controller));
		$this->view->encadres = Encadre::findEncadreEntite($this->view->en[0]->id);

		$query = $this->getRequest();
		$errors = array();
		if($query->isPost()) {
			$titre = $query->getParam('titre');
			$id = $query->getParam('id');
			//utile ?
			$notEmptyValidator = new Zend_Validate_NotEmpty();
			if(!$notEmptyValidator->isValid($titre)) {
				$errors[] = "Le titre ne peut être vide !";
			}
			if( count($errors) ) {
				$fm = $this->_helper->flashMessenger->addMessage($errors);
			//Utile ?
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
}?>