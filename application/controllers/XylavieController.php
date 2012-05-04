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
				$html = new Zend_View();
				$html->setScriptPath(APPLICATION_PATH . '/views/emails/');

				$html->assign('dateJour', $this->view->dateJour);
				$html->assign('controller', strtoupper($this->view->controller));
				$html->assign('civilite', $this->view->civilite);
				$html->assign('nom', $this->view->nom);
				$html->assign('prenom', $this->view->prenom);
				$html->assign('date', $this->view->date);
				$html->assign('conjoint', $this->view->conjoint);
				$html->assign('civC', $this->view->civC);
				$html->assign('nomC', $this->view->nomC);
				$html->assign('prenomC', $this->view->prenomC);
				$html->assign('dateC', $this->view->dateC);
				$html->assign('adresse', $this->view->adresse);
				$html->assign('mail', $this->view->mail);
				$html->assign('tel', $this->view->tel);
				$html->assign('rente', $this->view->rente);
				$html->assign('depT', $this->view->depT);
				$html->assign('depTP', $this->view->depTP);

				$mail = new Zend_Mail('utf-8');

				$bodyText = $html->render('devisdep.phtml');
				// $mailT = new Zend_Mail_Transport_Sendmail();
				// $mail->send($mailT);
				$mail->setFrom('noreply@xylavie.fr', 'Demande de Devis - XYLAVIE')
					->addTo('pierrejulien.martinez@gmail.com', 'XYLAVIE')
					->setBodyHtml($bodyText)
					->setSubject('Demande de Devis')
					->send();
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
			}
		}
        	}

        	public function devisassuranceemprunteurAction()
        	{
        		$this->view->form = new App_forms_emprunt();
        		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams()) && isset($_POST['iQapTcha']) && empty($_POST['iQapTcha']) && isset($_SESSION['iQaptcha']) && $_SESSION['iQaptcha']) {
				$this->view->civilite = $this->view->form->getCivilite();
                    			$this->view->nom = $this->view->form->getNom();
                    			$this->view->prenom = $this->view->form->getPrenom();
			}
		}
        	}
        	
	public function contactAction()
	{	
		// on ajoute le script d'initialisation de tinyMCE
		$script="
			tinyMCE.init({
				mode : 'textareas',
				theme : 'advanced',
				language : 'fr',
				skin : 'o2k7',
		       		skin_variant : 'silver',
				plugins : 'inlinepopups, paste',
				theme_advanced_buttons1 : 'code, bold, italic, underline, |, bullist, numlist, |, justifyleft, justifyright, justifycenter, justifyfull, |, link, unlink, |, formatselect, fontselect,fontsizeselect, |,forecolor',
				theme_advanced_buttons2 : '',
				theme_advanced_buttons3 : '',
				theme_advanced_buttons4 : '',
				theme_advanced_toolbar_location : 'top',
				theme_advanced_toolbar_align : 'left',
				paste_remove_styles : true,
				paste_remove_spans : true,
				paste_stip_class_attributes : 'all',
				theme_advanced_text_colors : '000000,ff6600,808000,008000,008080,0000ff,ff0000,333399',
				theme_advanced_more_colors : false,
				theme_advanced_default_foreground_color : '#000000'
			})
		";
		$this->view->headScript()->appendScript($script);
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
					->setSubject('Sujet de test')
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
	}
}

?>

