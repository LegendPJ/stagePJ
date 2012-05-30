<?php

class PagesController extends Zend_Controller_Action
{

	public function init()
	{

	}

	public function conditionsAction(){} //check

	public function mentionsAction(){} //check

	public function bugAction()
	{
		$this->view->form = new App_forms_erreur();
		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				$this->view->infos = $this->getRequest()->getParams();
				$layoutMail = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC = new Webf_Mail_Layout($path = APPLICATION_PATH."/layouts/mails","main");
				$layoutMailC->setScriptHtml("confirmSignaler");
				$layoutMail->setScriptHtml("signaler");
				$layoutMail->assign(array("infos" => $this->view->infos, "date" => $this->view->date));
				$layoutMailC->assign( array(
					"date" => $this->view->date,
					"civilite" => $this->view->infos['civilite'],
					"nom" => $this->view->infos['nom']
				));
				$mail = new Webf_Mail($layoutMail);
				$mailC = new Webf_Mail($layoutMailC);
				$sendGridTransporter = new Webf_Mail_Smtp_SendGrid('xylagroup','xylagroup2012');
				$mail->setSmtpTransporter($sendGridTransporter);
				$mailC->setSmtpTransporter($sendGridTransporter);
				$mail->setFrom('noreply@xylagroup.fr', 'Webmaster');
				$mailC->setFrom('noreply@xylagroup.fr', 'Webmaster');
				$mail->addTo('pierrejulien.martinez@gmail.com');
				$mailC->addTo($this->view->infos['email']);
				$mail->setSubject('Signaler Erreur');
				$mailC->setSubject('Signaler Erreur');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('L\'erreur a bien été envoyée au webmaster. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
				$this->_helper->Redirector->gotoUrl('/index');
			} else {
				$this->_helper->FlashMessenger('Le Formulaire comporte des erreurs')->setNamespace('error');
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}

	public function contactAction(){
		$this->view->mdp = "";
		$crypt = new Webf_RevCrypt("");
		$this->view->encod = $crypt->code($this->view->mdp);
		$this->view->decod = $crypt->decode("");
	} 

}	