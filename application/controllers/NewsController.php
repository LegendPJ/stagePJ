<?php

class NewsController extends Zend_Controller_Action
{

	public function init()
	{	
		$this->view->int = $this->_getParam('id');
	}

	public function indexAction()
 	{
 		$this->view->autres 		= 	News::newsVisible();
 	}

 	public function newsvueAction()
	{
		$this->view->theNews 	=	 News::findNewsVisible($this->view->int);
		if (count($this->view->theNews) ==0)
			$this->_redirect('/error');
		$this->view->nPrec 		=	 News::findPrecNews($this->view->theNews[0]->numero);
		$this->view->nNext 		=	 News::findNextNews($this->view->theNews[0]->numero);
		$this->view->autres 		=	 News::findAll();
	}

	public function modifAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$this->_helper->layout->setLayout('layoutstart');
		$this->view->news = News::findAllDesc();
		if (!empty($_POST)){ 
			if ($_POST['send'] == 'Sauvegarder' && $this->view->ident->droit > 15){ 
				$titre = $_POST['titre'];
				$id = $_POST['id'];
				News::updateTNews($titre, $id);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('Titre de la news modifié avec succès!');
				$this->_redirect('/news/modif');
			} elseif ($_POST['send'] == 'Supprimer' && $this->view->ident->droit > 15) {
				$iddel = $_POST['id_del'];
				News::deleteNews($iddel);
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('News supprimée avec succès!');
				$this->_redirect('/news/modif');
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
			$lien = $query->getParam('lien');
			$entite = $query->getParam('entite');
			if(!empty($_FILES['image']) && $_FILES['image']['size'] < 2100000) {
				$picture_temp = $_FILES['image']['tmp_name'];
				$picture = $_FILES['image']['name'];
				$nom = md5(uniqid(rand(), true));
				move_uploaded_file($picture_temp, $_SERVER['DOCUMENT_ROOT'].'/images/upload/'.$nom.'-'.$picture);
			}
			if($this->view->ident->droit < 15) {
				$visible = "non";
			} else {
				$visible = $query->getParam('visible'); }
			if (strlen($titre) != 0) {
				$now = Zend_Date::now();
				$today = explode(' ', $now);
				$numero		=	News::getLastNumero();
				$date			=	$today[0].' '.$today[1].' '.$today[2];
				$news 			= 	new News();
				$news->titre 		= 	$titre;
				$news->numero 	= 	$numero[0]->MAX+1;
				$news->contenu 	= 	$contenu;
				$news->auteur 	= 	$this->view->ident->name;
				$news->lien 		= 	$lien;
				$news->photo 	= 	$entite.'.jpg';
				if(!empty($picture))
					$news->image 	= 	$nom.'-'.$picture;
				$news->date 		= 	$date;
				$news->visible	= 	$visible;
				$news->save();
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('News ajoutée!');
				$this->_redirect('/news/modif');
			}
		}
	}

	public function editAction()
	{
		if (!Zend_Auth::getInstance()->hasIdentity())
			$this->_redirect('/');
		$this->_helper->layout->setLayout('layoutstart');
		$this->view->idNews = $this->_getParam('id');
		$this->view->news = News::findNews($this->view->idNews);
		$query = $this->getRequest();
		if($query->isPost()) {
			$titre = $query->getParam('titre');
			$contenu = $query->getParam('contenu');
			$lien = $query->getParam('lien');
			$entite = $query->getParam('entite');
			if(!empty($_FILES['image']) && $_FILES['image']['size'] < 2100000) {
				$picture_temp = $_FILES['image']['tmp_name'];
				$picture = $_FILES['image']['name'];
				$nom = md5(uniqid(rand(), true));
				move_uploaded_file($picture_temp, $_SERVER['DOCUMENT_ROOT'].'/images/upload/'.$nom.'-'.$picture);
			}
			if($this->view->ident->droit < 15) {
				$visible = "non";
			} else {
				$visible = $query->getParam('visible'); }
			if (strlen($titre) !=  0) {
				$photo = $entite.'.jpg';
				News::updateNews($titre, $contenu, $this->view->idNews, $lien, $photo, $visible);
				if(!empty($picture)) {
					$image = $nom.'-'.$picture;
					News::updateImageNews($image, $this->view->idNews);
					unlink($_SERVER['DOCUMENT_ROOT'].'/images/upload/'.$this->view->news[0]->image);
				}
				$this->_helper->FlashMessenger()->setNamespace('success')->addMessage('News modifiée avec succès!');
				$this->_redirect('/news/modif');
			}
		}
	}
}	