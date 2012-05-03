<?php 
class App_forms_emprunt extends Zend_Form 
{
	public function __construct() {

		$decorators =  array('ViewHelper', 'Errors',
				array('Description', array('tag' => 'p', 'class' => 'description')),
				array('HtmlTag', array('tag' => 'td')),
				array('Label', array('tag' => 'th')),
				array(array('tr' => 'HtmlTag'), array('tag' => 'tr'))
				);
		//DEBUT PROJET
		$this->montant = new Zend_Form_Element_Text('montant');
		$this->montant->setLabel("Montant (en €)")
			->setAttrib('placeholder', 'ex : 2000,50')
			->addValidator('Float')	
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(3,20))
			->setDecorators($decorators)
			->setRequired(true);

		$this->taux = new Zend_Form_Element_Text('taux');
		$this->taux->setLabel("Taux (en %)")
			->setAttrib('placeholder', 'ex : 4,25')
			->addValidator('Float')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('Between', false, array('min' => 0, 'max' => 100))
			->setDecorators($decorators)
			->setRequired(true);

		$this->duree = new Zend_Form_Element_Text('duree');
		$this->duree->setLabel("Durée (en mois)")
			->setAttrib('placeholder', 'ex : 12')
			->addValidator('Digits')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('Between', false, array('min' => 1, 'max' => 1200))
			->setDecorators($decorators)
			->setRequired(true);

		$this->dateE = new Zend_Form_Element_Text('dateE', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->dateE->setLabel("Date d'effet")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		$this->garanties = new Zend_Form_Element_Select('garanties');
		$this->garanties->setLabel("Garanties souhaitées")
			->setDecorators($decorators)
			->addMultiOptions(array('Décès'=>'Décès','Décès et Chômage'=>'Décès et Chômage', 'Décès et Option Arrêt de Travail/Invalidité'=>'Décès et Option Arrêt de Travail/Invalidité', 'Décès et Option Arrêt de Travail/Invalidité et Chômage'=>'Décès et Option Arrêt de Travail/Invalidité et Chômage'));

		$this->autre = new Zend_Form_Element_Select('autre');
		$this->autre->setLabel("Autre prêt ?")
			->setDecorators($decorators)
			->addMultiOptions(array('Non'=>'Non','Oui'=>'Oui'));

		$this->type = new Zend_Form_Element_Select('type');
		$this->type->setLabel("Type de prêt")
			->setDecorators($decorators)
			->addMultiOptions(array('' => '', 'Amortissable'=>'Amortissable','In Fine'=>'In Fine'));

		$this->banque = new Zend_Form_Element_Select('banque');
		$this->banque->setLabel("Banque")
			->setDecorators($decorators)
			->addMultiOptions(array(''=>'','BNP Paribas'=>'BNP Paribas', 'Banque Populaire'=>'Banque Populaire', 'Banque Postale'=>'Banque Postale', 'Caisse d\'épargne'=>'Caisse d\'épargne', 'Crédit Agricole'=>'Crédit Agricole', 'LCL'=>'LCL', 'Société Générale'=>'Société Générale', 'Crédit Mutuel'=>'Crédit Mutuel', 'Barclays'=>'Barclays', 'CIC'=>'CIC', 'Crédit du Nord'=>'Crédit du Nord', 'Crédit Foncier de France'=>'Crédit Foncier de France', 'Crédit Immobilier de France'=>'Crédit Immobilier de France', 'HSBC'=>'HSBC', 'Autre'=>'Autre'	));

		$this->differe = new Zend_Form_Element_Text('differe');
		$this->differe->setLabel("Différé (en mois)")
			->setAttrib('placeholder', 'ex : 12')
			->addValidator('Digits')
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('Between', false, array('min' => 1, 'max' => 1200))
			->setDecorators($decorators);
		//FIN PROJET
		//DEBUT EMPRUNTEUR

		$this->civ = new Zend_Form_Element_Radio('civ');
		$this->civ->setLabel("Vous êtes")
			->setMultiOptions(array('M.'=>'M.','Mme.'=>'Mme.', 'Mlle.' => 'Mlle.'))
			->setDecorators($decorators)
			->setRequired(true)
			->setOptions(array('separator'=>''));
		               
		$this->nom = new Zend_Form_Element_Text('nom');
		$this->nom->setLabel("Votre Nom")
			->addValidator('Alpha') //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);
					   
		$this->prenom = new Zend_Form_Element_Text('prenom');
		$this->prenom->setLabel("Votre Prénom")
			->addValidator('Alpha') //que des lettres !
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->setDecorators($decorators)
			->setRequired(true);

		$this->dateN = new Zend_Form_Element_Text('dateN', array('readonly' => 'readonly', 'class' => 'datepicker'));
		$this->dateN->setLabel("Date de Naissance")
			->setAttrib('placeholder', 'Cliquez puis choisissez')
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array(10,10))
			->addValidator('regex', true, array('/^\d{2}\/\d{2}\/\d{4}$/', 'messages' => 'Format de date incorrect'))
			->addValidator('Date', true, array('format' => 'dd/mm/aaaa'))
			->setDecorators($decorators);

		$this->fumeur = new Zend_Form_Element_Radio('fumeur');
		$this->fumeur->setLabel("Êtes-vous fumeur ?")
			->setDecorators($decorators)
			->setOptions(array('separator'=>''))
			->addMultiOptions(array('Oui'=>'Oui','Non'=>'Non'))
			->setRequired(true);

		$this->quotite = new Zend_Form_Element_Select('quotite');
		$this->quotite->setLabel("Quotité à assurer")
			->setDecorators($decorators)
			->addMultiOptions(array(''=>'','5%'=>'5%', '10%'=>'10%', '15%'=>'15%', '20%'=>'20%', '25%'=>'25%', '30%'=>'30%', '35%'=>'35%', '40%'=>'40%', '45%'=>'45%', '50%'=>'50%', '55%'=>'55%', '60%'=>'60%', '65%'=>'65%', '70%'=>'70%', '75%'=>'75%', '80%'=>'80%', '85%'=>'85%', '90%'=>'90%', '95%'=>'95%', '100%'=>'100%'))
			->setRequired(true);

		$this->km = new Zend_Form_Element_Select('km');
		$this->km->setLabel("Nombre de km par an")
			->setDecorators($decorators)
			->addMultiOptions(array('+ de 15.000'=>'+ de 15.000', '- de 15.000'=>'- de 15.000'));

		$this->IPT = new Zend_Form_Element_Radio('IPT');
		$this->IPT->setLabel("Option IPT/ITT")
			->setDecorators($decorators)
			->setOptions(array('separator'=>''))
			->addMultiOptions(array('Oui'=>'Oui','Non'=>'Non'))
			->setRequired(true);

		$this->IPP = new Zend_Form_Element_Radio('IPP');
		$this->IPP->setLabel("Option IPP")
			->setDecorators($decorators)
			->setOptions(array('separator'=>''))
			->addMultiOptions(array('Oui'=>'Oui','Non'=>'Non'))
			->setRequired(true);

		$this->submit = new Zend_Form_Element_Submit('Envoyer');
		$this->submit->setDecorators(array('ViewHelper',
						array(array('td' => 'HtmlTag'), array('tag' => 'td', 'colspan' => 2)),
						array(array('tr' => 'HtmlTag'), array('tag' => 'tr')))
						);

		$this->addElements(array(
			$this->montant,
			$this->taux,
			$this->duree,
			$this->dateE,
			$this->garanties,
			$this->autre,
			$this->type,
			$this->banque,
			$this->differe,
			$this->civ,
			$this->nom,
			$this->prenom,
			$this->dateN,
			$this->fumeur,
			$this->quotite,
			$this->km,
			$this->IPT,
			$this->IPP
		));

		$this->setDecorators(array('FormElements',
					array('HtmlTag', array('tag' => 'table')),
				'Form'));             
	}

	public function getCivilite() { return $this->civ->getValue(); }

	public function getNom() { return $this->nom->getValue(); }
	
	public function getPrenom() { return $this->prenom->getValue(); }

	public function getDate() { return $this->dateN->getValue(); }
              
	public function getConjoint() { return $this->conjoint->getValue(); }

	public function getCivC() { return $this->civC->getValue(); }

	public function getNomC() { return $this->nomC->getValue(); }

	public function getPrenomC() { return $this->prenomC->getValue(); }

	public function getDateC() { return $this->dateC->getValue(); }

	public function getAdresse() { return $this->adresse->getValue(); }
	
	public function getCodeP() { return $this->codeP->getValue(); }

	public function getVille() { return $this->ville->getValue(); }
              
	public function getMail() { return $this->email->getValue(); }	

	public function getTel() { return $this->telephone->getValue(); }	

	public function getRente() { return $this->rente->getValue(); }	

	public function getDepT() { return $this->depT->getValue(); }

	public function getDepTP() { return $this->depTP->getValue(); }
}
 ?>