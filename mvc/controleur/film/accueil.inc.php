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
class controleurFilmAccueil extends controleur {
	private $modeleFilm;
	
    public function __construct() {
        $this->modeleFilm = new modeleFilmAccueil();
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
		$this->titreHeader = "page d'accueil des films";
		$this->titreMain = "page d'accueil des films";
		

		$this->enteteLien = "<link rel='stylesheet' type='text/css' href='./librairie/simpleSlideShow/css/simpleSlideShow.css'/>\n";
		$this->enteteLien .= "<script type='text/javascript' src='./librairie/simpleSlideShow/js/simpleSlideShow.js'></script>\n";	
		$this->enteteLien .= "<link rel='stylesheet' type='text/css' href='./css/filmAccueil.css'/>\n";

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
		// galerie
		// ===============================================================================================================
		$this->galerie = $this->getGalerie(configuration::get("nbImageSlideShowAccueilFilm"));
		
		// ===============================================================================================================
		// alimentation des données COMMUNES à toutes les pages
		// ===============================================================================================================
		parent::setDonnees();
	}
	
	/**
	 * Génère l'affichage de la vue pour l'action par défaut de la page 
	 * @param null
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - Juin 2017
	 */
	
	
	public function defaut() {
	    
	    // $this->nbFilms = 119;
	    $this->nbFilms = $this->modeleFilm->getNbFilms();
		parent::genererVue();
	}
	
	/**
	 * 
	 * @param integer : le nombre d'images du slide
	 * @return array
	 * @version 1.4
	 * @author Loris Fariello 
	 * @copyright Loris Fariello - octobre 2019
	 */
	
	private function getGalerie($nbImage) {
	    $dirImage = scandir(configuration::get("dirImageSlideShowAccueilFilm"));
	    $dirImage = array_diff($dirImage, array(".", ".."));
	    $max = count($dirImage);
	    $galerie = array();
	    
	    $listeNum = array();
	    
	    
	    
	    for ($i = 0; $i < $nbImage; $i++) {
	        
	        do {
	            $nbAlea = rand(2, $max);
	        } while(in_array($nbAlea, $listeNum));
	        $listeNum[] = $nbAlea;
	        
	        $adress = $dirImage[$nbAlea];
	        $titre = substr($adress, 0, (strlen($adress)) - 4);
	        
	        if ($titre == "Aucune affiche") {
	            $this->getGalerie($nbImage);
	        }
	        $numFilm = $this->modeleFilm->getNumFilm($titre);

	        $galerie[$i]["numFilm"] = $numFilm;
	        $galerie[$i]["affiche"] = configuration::get("dirImageSlideShowAccueilFilm") . $titre . ".jpg" ;
	        
	    }
	    
	    
	    return $galerie;
	}
	

	


} // class

?>

