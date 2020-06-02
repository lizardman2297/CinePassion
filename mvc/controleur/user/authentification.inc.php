<?php
/*======= C O N T R O L E U R ====================================================================================
	fichier				: ./mvc/controleur/user/authentification.inc.php
	auteur				: Loris Fariello
	date de création	: mai 2020
	date de modification:
	rôle				: le contrôleur de lies a l'authentification
  ================================================================================================================*/

/**
 * Classe relative au contrôleur de la page inscription du domaine film
 * @author Loris Fariello
 * @version 1.0
 * @copyright Loris Fariello - mai 2020
 */
class controleurUserAuthentification  extends controleur {
	    
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
        
        

		parent::setDonnees();
	}
	
	/**
	 * Génère l'affichage de la vue pour l'action par défaut de la page 
	 * @param null
	 * @return null
	 * @author Fariello Loris
	 * @version 1.0
	 * @copyright Fariello Loris - mai 2020
	 */
	
	public function defaut() {
		parent::genererVue();
	}
	
} // class

?>

