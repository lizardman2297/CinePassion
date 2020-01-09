<?php
/*======= C O N T R O L E U R ====================================================================================
	fichier				: ./mvc/controleur/film/accueil.inc.php
	auteur				: Loris Fariello
	date de création	: octobre 2019
	date de modification:
	rôle				: le contrôleur de la page d'accueil des films
  ================================================================================================================*/

/**
 * Classe relative au contrôleur de la page accueil du domaine film
 * @author Loris Fariello
 * @version 1.0
 * @copyright Loris Fariello - octobre 2019
 */
class controleurUserAccueil extends controleur {
	    
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
// 		$this->encartsDroite = "partenaires.txt";
 		//$this->encartsGauche = "partenaireEmpire.txt";
		//$this->encartsGauche = "partenaires.txt";

		$this->encartsDroite = parent::getEncart(2);
				
		// ===============================================================================================================
		// texte défilant
		// ===============================================================================================================
		// rien
		
		// ===============================================================================================================
		// alimentation des données COMMUNES à toutes les pages
		// ===============================================================================================================
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
	
} // class

?>

