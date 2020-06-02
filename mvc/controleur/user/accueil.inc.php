<?php
/*======= C O N T R O L E U R ====================================================================================
	fichier				: ./mvc/controleur/user/accueil.inc.php
	auteur				: Loris Fariello
	date de création	: mais2020
	date de modification:
	rôle				: le contrôleur de la page d'accueil user
  ================================================================================================================*/

/**
 * Classe relative au contrôleur de la page accueil du domaine user
 * @author Loris Fariello
 * @version 1.0
 * @copyright Loris Fariello - mai 2020
 */
class controleurUserAccueil extends controleur {
	public function __construct(){
		$this->modele = new modeleUserAuthentification();
	}

	
	/**
	 * Met à jour le tableau $donnees de la classe mère avec les informations spécifiques de la page
	 * @param null
	 * @return null
	 * @author Loris Fariello
	 * @version 1.0
	 */
	public function setDonnees() {
		// ===============================================================================================================
		// titres de la page
		// ===============================================================================================================
		$this->titreHeader = "page d'accueil des utilisateurs";
		$this->titreMain = "page d'accueil des utilisateurs";
		

		$this->enteteLien = "<link rel='stylesheet' type='text/css' href='./css/userAccueil.css'/>\n";

		// ===============================================================================================================
		// encarts
		// ===============================================================================================================
		// $this->encartsDroite = "partenaires.txt";
 		//$this->encartsGauche = "partenaireEmpire.txt";
		//$this->encartsGauche = "partenaires.txt";

		$this->encartsDroite = parent::getEncart(2);

		$this->user = $this->getInfo();

		parent::setDonnees();

		
	}
	
	/**
	 * Génère l'affichage de la vue pour l'action par défaut de la page 
	 * @param null
	 * @return null
	 * @author Fariello Loris
	 * @version 1.0
	 * @copyright Fariello Loris - Janvier 2020
	 */
	
	public function defaut() {
		parent::genererVue();
	}

	public function getInfo()
	{
		if (isset($_POST["login"]) && isset($_POST["password"])) {
			return $this->modele->getInformationsUser($_POST["login"], $_POST["password"]);
		}
	}
	
} // class

?>

