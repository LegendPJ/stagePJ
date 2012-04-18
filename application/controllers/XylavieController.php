<?php

class XylavieController extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->nomXyla = "XylaVIE";
		$this->view->module = $this->getRequest()->getModuleName(); 
		// recupere le module
		$this->view->controller = $this->getRequest()->getControllerName(); 
		// recupere le controller
		$this->view->action = $this->getRequest()->getActionName(); 
		// recupere l'action
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
		$this->view->form = new App_forms_contact();
		if ($this->getRequest()->isPost()) {
			if($this->view->form->isValid($this->getRequest()->getParams())) {
//				$this->_helper->Redirector->gotoUrl('/xylavie/');
                            			$this->view->nom = $this->view->form->getNom();
				$flashMessenger = $this->_helper->getHelper('FlashMessenger');
				$message = 'Nous avons fait quelquechose lors de la dernière requête';
				$flashMessenger->addMessage($message);
			}
			else {
				$this->view->errorElements = $this->view->form->getMessages();
			}
		}
	}
}

?>

