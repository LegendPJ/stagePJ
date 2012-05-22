<?php

class XylariskController extends Zend_Controller_Action
{

	public function init()
	{	
	}

	public function indexAction()
	{
		$this->view->en 		= 	Entite::findEntity(strtoupper($this->view->controller));
		$this->view->encEnti		= 	Encadre::findEncadreEntite($this->view->en[0]->id); 
								//on récupère les encadre relatifs à l'entité (XYLARISK)
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
                    			$mail->setFrom('noreply@xylarisk.fr', 'XYLARISK - Service Contact');
                    			$mailC->setFrom('noreply@xylarisk.fr', 'XYLARISK - Service Contact');
				$mail->addTo('pierrejulien.martinez@gmail.com', 'XYLARISK');
				$mailC->addTo('pierrejulien.martinez@gmail.com');
				$mail->setSubject('Contact XYLARISK');
				$mailC->setSubject('Contact XYLARISK');
				$mail->send();
				$mailC->send();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Demande de devis envoyée correctement à la société '.strtoupper($this->view->controller).'. Nous mettons tout en oeuvre pour vous répondre au plus vite. Merci');
				$this->_helper->Redirector->gotoUrl('/xylarisk/');
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
		$this->view->en 		= 	Entite::findEntity(strtoupper($this->view->controller));
		$this->view->encadres	= 	Encadre::findEncadreEntite($this->view->en[0]->id); 
		
		if (!empty($_POST)){ 
			if ($_POST['send'] == 'Sauvegarder'){ 
				$titre = $_POST['titre'];
				$id = $_POST['id'];
				Encadre::updateTEncadre($titre, $id);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Titre modifié avec succès!');
				$this->_redirect('/xylarisk/modif');
			} elseif ($_POST['send'] == 'Supprimer') {
				$iddel = $id = $_POST['id_del'];
				Encadre::deleteEncadre($iddel);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Titre supprimé avec succès!');
				$this->_redirect('/xylarisk/modif');
			}	
		}
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
				$this->_redirect('/xylarisk/modif');
			}
		}
	}
}
?>

