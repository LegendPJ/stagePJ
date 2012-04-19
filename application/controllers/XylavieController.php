<?php

class XylavieController extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->nomXyla = "XylaVIE";
	}

	public function indexAction()
	{
		$this->view->en 		= 	Entite::findEntity(strtoupper($this->view->controller));
		$this->view->encEnti		= 	Encadre::findEncadreEntite($this->view->en[0]->id); 
								//on récupère les encadre relatifs à l'entité (XYLAVIE)
	}

	public function devisAction()
	{
            
	}
        
	public function contactAction()
	{	
		// on ajoute le script d'initialisation de tinyMCE
		$script="
			tinyMCE.init({
				mode : 'textareas',
				theme : 'advanced',
				plugins : 'inlinepopups, paste',
				skin : 'o2k7',
				skin_variant : 'silver',
				theme_advanced_buttons1 : 'bold, italic, underline, |, bullist, numlist, |, justifyleft, justifyright, justifycenter, justifyfull, |, link, unlink, |, formatselect, fontselect,fontsizeselect, |,forecolor,backcolor',
				theme_advanced_buttons2 : '',
				theme_advanced_buttons3 : '',
				theme_advanced_buttons4 : '',
				theme_advanced_toolbar_location : 'top',
				theme_advanced_toolbar_align : 'left',
				paste_remove_styles : true,
				paste_remove_spans : true,
				paste_stip_class_attributes : 'all'
			})
		";
		$this->view->headScript()->appendScript($script);
		$this->view->form = new App_forms_contact();
		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
				// $this->_helper->Redirector->gotoUrl('/xylavie/');
                            			$this->view->civilite = $this->view->form->getCivilite();
                            			$this->view->nom = $this->view->form->getNom();
                            			$this->view->email = $this->view->form->getEmail();
                            			$this->view->telephone = $this->view->form->getTelephone();
                            			$this->view->message = $this->view->form->getMessage();
                            			// ICI on envoie le mail !
                            			
                            			$this->_forward('verif', $this->view->controller,null, array('c'=> $this->view->civilite,'n'=> $this->view->nom,'e'=> $this->view->email,'t' => $this->view->telephone, 'm'=> $this->view->message));
			}
			else {
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}

	public function verifAction() 
	{
		$this->view->civilite = $this->_getParam('c');
		$this->view->nom = $this->_getParam('n');
		$this->view->email = $this->_getParam('e');
		$this->view->telephone = $this->_getParam('t');
		$this->view->message = $this->_getParam('m');
	}
}

?>

