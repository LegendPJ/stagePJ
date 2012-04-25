<?php

class XylabtpController extends Zend_Controller_Action
{

	public function init()
	{
	}

	public function indexAction()
	{
		$this->view->en 		= 	Entite::findEntity(strtoupper($this->view->controller));
		$this->view->encEnti		= 	Encadre::findEncadreEntite($this->view->en[0]->id); 
								//on récupère les encadre relatifs à l'entité (XYLABTP)
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
                            			$this->view->email = $this->view->form->getEmail();
                            			$this->view->telephone = $this->view->form->getTelephone();
                            			$this->view->message = $this->view->form->getMessage();
                            			
                            			$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				$date = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");

				$mailT = new Zend_Mail_Transport_Sendmail();
				$mail = new Zend_Mail();
				$contenu = '<span style="font-weight:bold">Bonjour, <br><br>En date du '.$date.' la société '.strtoupper($this->view->controller).' a reçu un message de la part de '.$this->view->civilite.' '.$this->view->nom.'</span><br><br>'.$this->view->message.'<br>Ses coordonnées sont les suivantes : <br>Email : '.$this->view->email.'<br>Tel : '.$this->view->telephone.'<br><br>Bonne journée';
				$mail->setFrom('noreply@xylabtp.fr', 'Contact - XYLABTP')
					->addTo('info@xylabtp.fr', 'XYLABTP')
					->setBodyHtml($contenu, 'UTF-8')
					->setSubject('Sujet de test')
					->send($mailT);
				$this->_helper->Redirector->gotoUrl('/xylabtp/');

                            			// $this->_forward('verif', $this->view->controller,null, array('c'=> $this->view->civilite,'n'=> $this->view->nom,'e'=> $this->view->email,'t' => $this->view->telephone, 'm'=> $this->view->message));
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
	}
}

?>

