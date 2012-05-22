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
				$this->view->adresse = $this->view->infos['adresse'].'<br>'. $this->view->infos['codeP'].' '.$this->view->infos['ville'];
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisSan");
				$layoutMail->setScriptHtml("devissan");
				$layoutMail->assign(array("infos" => $this->view->infos, "date" => $this->view->date));
				$layoutMailC->assign(array(
					"date" => $this->view->date,
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
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisDep");
				$layoutMail->setScriptHtml("devisdep");
				$layoutMail->assign( array("date" => $this->view->date,"infos" => $this->view->infos));
				$layoutMailC->assign( array(
					"date" => $this->view->date,
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
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisRet");
				$layoutMail->setScriptHtml("devisret");
				$layoutMail->assign(array("date" => $this->view->date, "infos" => $this->view->infos));
				$layoutMailC->assign( array(
					"date" => $this->view->date,
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
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisEpa");
				$layoutMail->setScriptHtml("devisepa");
				$layoutMail->assign(array("date" => $this->view->date, "infos" => $this->view->infos));
				$layoutMailC->assign( array(
					"date" => $this->view->date,
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
				$this->view->infos = $this->getRequest()->getParams();
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisAss");
				$layoutMail->setScriptHtml("devisass");
				$layoutMail->assign(array("date" => $this->view->date, "infos" => $this->view->infos));
				$layoutMailC->assign(array(
					"date" => $this->view->date,
					"controller" => strtoupper($this->view->controller),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom']
				));
				$mail = new Webf_Mail($layoutMail);
				$mailC = new Webf_Mail($layoutMailC);
				$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('xylagroup','xylagroup2012');
				$mail->setSmtpTransporter($sendGridTransporter);
				$mailC->setSmtpTransporter($sendGridTransporter);
				$mail->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Assurance Emprunteur');
				$mailC->setFrom('noreply@xylavie.fr', 'XYLAVIE - Devis Assurance Emprunteur');
				// $mail->addTo('eberard@xylavie.fr', 'XYLAVIE');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE');
				$mailC->addTo('pierrejulien.martinez@gmail.com');
				$mail->setSubject('Demande de Devis Assurance Emprunteur');
				$mailC->setSubject('Demande de Devis Assurance Emprunteur');
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
	        
	public function prevoyanceAction()
	{
		$this->view->form = new App_forms_prevoyance();
		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				$this->view->infos = $this->getRequest()->getParams();
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisPre");
				$layoutMail->setScriptHtml("devispre");
				$layoutMail->assign(array("date" => $this->view->date, "infos" => $this->view->infos));
				$layoutMailC->assign(array(
					"date" => $this->view->date,
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
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmcontact");
				$layoutMail->setScriptHtml("contact");
				$layoutMail->assign(array("infos" => $this->view->infos, "date" => $this->view->date));
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
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisAcc");
				$layoutMail->setScriptHtml("devisacc");
				$layoutMail->assign(array("date" => $this->view->date,"infos" => $this->view->infos));				
				$layoutMailC->assign( array(
					"date" => $this->view->date,
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

		if (!empty($_POST)){ 
			if ($_POST['send'] == 'Sauvegarder'){ 
				$titre = $_POST['titre'];
				$id = $_POST['id'];
				Encadre::updateTEncadre($titre, $id);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Titre modifié avec succès!');
				$this->_redirect('/xylavie/modif');
			} elseif ($_POST['send'] == 'Supprimer') {
				$iddel = $_POST['id_del'];
				Encadre::deleteEncadre($iddel);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Titre supprimé avec succès!');
				$this->_redirect('/xylavie/modif');
			} elseif ($_POST['send'] == 'Ordonner') {
				$nb = $_POST['nombre'];
				$this->view->tabID = array();
				$this->view->tabOrdre = array();
				for ($i=0; $i < $nb; $i++) { 
					$o = $_POST[$i+1];
					$elems = explode("-", $o);
					// $e = 'idAmod'.$i; CA NE SERT PLUS A RIEN C'EST JUSTE AU CAS OU 
					// $$e = $elems[1]; CA NE SERT PLUS A RIEN C'EST JUSTE AU CAS OU 
					// $var = 'encadre'.$i; CA NE SERT PLUS A RIEN C'EST JUSTE AU CAS OU 
					// $$var = Encadre::getLOrdre($elems[0]); CA NE SERT PLUS A RIEN C'EST JUSTE AU CAS OU 
					$this->view->tabID[$i] = $elems[1];
					$this->view->tabOrdre[$i] = $elems[0];
				}
				// for ($i=0; $i < $nb; $i++) { 
				// 	Encadre::updateOrdre($tabOrdre['encadre'.$i], $tabID['encadre'.$i]);
				// }
				// $this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Ordre modifié avec succès!');
				// $this->_redirect('/xylavie/modif');
			}	
		}
	}

	public function suppAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$query = $this->getRequest();
		// Encadre::delete();
		$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Titre supprimé!');
		$this->_redirect('/xylavie/modif');
	}

	public function ajouterAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$this->_helper->layout->setLayout('layoutstart');
		$query = $this->getRequest();
		if($query->isPost()) {
			$titre = $query->getParam('titre');
			$contenu = $query->getParam('contenu');
			if (strlen($titre) != 0) {
				$this->view->enid 	= 	Entite::findEntity(strtoupper($this->view->controller));
				$this->view->ordre	=	Encadre::getLastOrdre($this->view->enid[0]->id);
				$encadre 		= 	new Encadre();
				$encadre->titre 	= 	$titre;
				$encadre->entite_id 	= 	$this->view->enid[0]->id;
				$encadre->contenu 	= 	$contenu;
				$encadre->ordre 	= 	$this->view->ordre[0]['MAX']+1;
				$encadre->save();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Grand Titre ajouté!');
				$this->_redirect('/xylavie/modif');
			}
		}
	}

}?>