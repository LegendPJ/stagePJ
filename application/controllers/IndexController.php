<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{

	}

	public function indexAction()
	{
		$entiteAccueil 			= 	Entite::findAccueil(); //on recupere la ligne d'ACCUEIL
		$this->view->encadreAccueil 		= 	Encadre::findEncadreEntite($entiteAccueil[0]->id); //on récupère les encadre relatifs à ACCUEIL
		$this->view->last 			= 	News::findLastNews(); //on récupère la denière news
	}

	public function modifAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$this->_helper->layout->setLayout('layoutstart');
		$this->view->en = Entite::findEntity('ACCUEIL');
		$this->view->encadres = Encadre::findEncadreEntite($this->view->en[0]->id);

		if (!empty($_POST)){ 
			if ($_POST['send'] == 'Sauvegarder'){ 
				$titre = $_POST['titre'];
				$id = $_POST['id'];
				Encadre::updateTEncadre($titre, $id);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Titre modifié avec succès!');
				$this->_redirect('/index/modif');
			} elseif ($_POST['send'] == 'Supprimer') {
				$iddel = $_POST['id_del'];
				Sousencadre::deleteFromEncadre($iddel);
				Encadre::deleteEncadre($iddel);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Titre supprimé avec succès!');
				$this->_redirect('/index/modif');
			} elseif ($_POST['send'] == 'Ordonner') {
				foreach ($_POST as $k => $p) {
					$p = explode("-", $p);
					Encadre::updateOrdre($p[1]+1, $p[0]);
				}
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Ordre modifié avec succès!');
				$this->_redirect('/index/modif');
			}	
		}
	}

	public function editAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$this->_helper->layout->setLayout('layoutstart');
		$this->view->idEnc = $this->_getParam('id');
		$this->view->encadre = Encadre::findEncadre($this->view->idEnc);
		$query = $this->getRequest();
		if($query->isPost()) {
			$titre = $query->getParam('titre');
			$contenu = $query->getParam('contenu');
			$idEncadre = $query->getParam('id_enca');
			if (strlen($titre) != 0) {
				Encadre::updateEnca($titre, $contenu, $idEncadre);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('L\'encadré à été modifié!');
				$this->_redirect('/index/modif');
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
				$this->view->enid 	= 	Entite::findEntity('ACCUEIL');
				$this->view->ordre	=	Encadre::getLastOrdre($this->view->enid[0]->id);
				$encadre 		= 	new Encadre();
				$encadre->titre 	= 	$titre;
				$encadre->entite_id 	= 	$this->view->enid[0]->id;
				$encadre->contenu 	= 	$contenu;
				$encadre->ordre 	= 	$this->view->ordre[0]['MAX']+1;
				$encadre->save();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Grand Titre ajouté!');
				$this->_redirect('/index/modif');
			}
		}
	}

	public function soustitreAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$this->_helper->layout->setLayout('layoutstart');
		$this->view->idSE = $this->_getParam('id');
		$this->view->titre = Encadre::findEncadre($this->view->idSE);
		$this->view->soustitres = Sousencadre::findSousencadEncad($this->view->idSE);

		if (!empty($_POST)){ 
			if ($_POST['send'] == 'Sauvegarder'){ 
				$titre = $_POST['titre'];
				$id = $_POST['id'];
				Sousencadre::updateTsousencadre($titre, $id);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Sous-Titre modifié avec succès!');
				$this->_redirect('/index/soustitre/id/'.$this->view->idSE);
			} elseif ($_POST['send'] == 'Supprimer') {
				$iddel = $_POST['id_del'];
				Sousencadre::deleteSousencadre($iddel);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Sous-Titre supprimé avec succès!');
				$this->_redirect('/index/soustitre/id/'.$this->view->idSE);
			} elseif ($_POST['send'] == 'Ordonner') {
				foreach ($_POST as $k => $p) {
					$p = explode("-", $p);
					Sousencadre::updateOrdre($p[1]+1, $p[0]);
				}
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Ordre modifié avec succès!');
				$this->_redirect('/index/soustitre/id/'.$this->view->idSE);
			}	
		}
	}

	public function ajouterstAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$this->_helper->layout->setLayout('layoutstart');
		$this->view->idT = $this->_getParam('id');
		$this->view->titre = Encadre::findEncadre($this->view->idT);
		$query = $this->getRequest();
		if($query->isPost()) {
			$titre = $query->getParam('titre');
			$contenu = $query->getParam('contenu');
			if (strlen($titre) != 0) {
				$this->view->ordre		=	Sousencadre::getLastOrdre($this->view->idT);
				$sousencadre 			= 	new Sousencadre();
				$sousencadre->titre 		= 	$titre;
				$sousencadre->encadre_id 	= 	$this->view->idT;
				$sousencadre->contenu 	= 	$contenu;
				$sousencadre->ordre 		= 	$this->view->ordre[0]['MAX']+1;
				$sousencadre->save();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Sous Titre ajouté!');
				$this->_redirect('/index/soustitre/id/'.$this->view->idT);
			}
		}
	}

}	