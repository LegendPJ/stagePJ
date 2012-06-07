<?php

class DevisController extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
	}

	public function santeAction()
	{
		$this->view->form = new App_forms_sante();
		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				$this->view->infos = $this->getRequest()->getParams();
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmDevisSan");
				$layoutMail->setScriptHtml("devissan");
				$layoutMail->assign(array("infos" => $this->view->infos, "date" => $this->view->date));
				$layoutMailC->assign(array(
					"date" => $this->view->date,
					"controller" => strtoupper('xylavie'),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom']
				));
				$mail = new Webf_Mail($layoutMail);
				$mailC = new Webf_Mail($layoutMailC);
				$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('xylagroup','xylagroup2012');
				$mail->setSmtpTransporter($sendGridTransporter);
				$mailC->setSmtpTransporter($sendGridTransporter);
				$mail->setFrom('noreply@xylavie.fr', 'XYLAVIE - Sante');
				$mailC->setFrom('noreply@xylavie.fr', 'XYLAVIE - Sante');
				// $mail->addTo('eberard@xylavie.fr', 'XYLAVIE');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE');
				$mail->addCc('pierrejulien.martinez@live.fr', 'XYLAVIE');
				$mailC->addTo($this->view->infos['email']);
				$mail->setSubject('Demande de Devis Sante');
				$mailC->setSubject('Demande de Devis Sante');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de devis Santé envoyée correctement à la société '.strtoupper('xylavie').'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
				$this->_helper->Redirector->gotoUrl('/xylavie/');
			} else {
				$this->_helper->FlashMessenger('Le formulaire comporte des erreurs')->setNamespace('error');
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}

	}

	public function dependanceAction()
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
					"controller" => strtoupper('xylavie'),
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
				$mailC->addTo($this->view->infos['email']);
				$mail->setSubject('Demande de Devis Dependance');
				$mailC->setSubject('Demande de Devis Dependance');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de devis Dépendance envoyée correctement à la société '.strtoupper('xylavie').'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
				$this->_helper->Redirector->gotoUrl('/xylavie/');
			} else {
				$this->_helper->FlashMessenger('Le formulaire comporte des erreurs')->setNamespace('error');
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}
	        
	public function retraiteAction()
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
					"controller" => strtoupper('xylavie'),
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
				$mailC->addTo($this->view->infos['email']);
				$mail->setSubject('Demande de Devis Retraite');
				$mailC->setSubject('Demande de Devis Retraite');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de devis Retraite envoyée correctement à la société '.strtoupper('xylavie').'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
				$this->_helper->Redirector->gotoUrl('/xylavie/');
			} else {
				$this->_helper->FlashMessenger('Le formulaire comporte des erreurs')->setNamespace('error');
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}

	public function epargneAction()
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
					"controller" => strtoupper('xylavie'),
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
				$mailC->addTo($this->view->infos['email']);
				$mail->setSubject('Demande de Devis Epargne');
				$mailC->setSubject('Demande de Devis Epargne');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de devis Epargne envoyée correctement à la société '.strtoupper('xylavie').'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
				$this->_helper->Redirector->gotoUrl('/xylavie/');
			} else {
				$this->_helper->FlashMessenger('Le formulaire comporte des erreurs')->setNamespace('error');
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}

	public function emprunteurAction()
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
					"controller" => strtoupper('xylavie'),
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
				$mailC->addTo($this->view->infos['email']);
				$mail->setSubject('Demande de Devis Assurance Emprunteur');
				$mailC->setSubject('Demande de Devis Assurance Emprunteur');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de devis Assurance Emprunteur envoyée correctement à la société '.strtoupper('xylavie').'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
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
					"controller" => strtoupper('xylavie'),
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
				$mailC->addTo($this->view->infos['email']);
				$mail->setSubject('Demande de Renseignements Prevoyance');
				$mailC->setSubject('Demande de Renseignements Prevoyance');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de renseignements envoyée correctement à la société '.strtoupper('xylavie').'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
				$this->_helper->Redirector->gotoUrl('/xylavie/');
			} else {
				$this->_helper->FlashMessenger('Le formulaire comporte des erreurs')->setNamespace('error');
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}

	public function accidentsAction()
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
					"controller" => strtoupper('xylavie'),
					"civilite" => $this->view->infos['civ'],
					"nom" => $this->view->infos['nom'],
					"hide" => $this->view->infos['hide'],
					"contrat" => $this->view->infos['contrat']
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
				$mailC->addTo($this->view->infos['email']);
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

} ?>