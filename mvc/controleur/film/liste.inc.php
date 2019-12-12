<?php
/*======= C O N T R O L E U R ====================================================================================
	fichier				: ./mvc/controleur/film/liste.inc.php
	auteur				: Loris Fariello
	date de création	: octobre 2019
	date de modification:
	rôle				: le contrôleur de la page liste des films
  ================================================================================================================*/

/**
 * Classe relative au contrôleur de la page liste du domaine film
 * @author Loris Fariello
 * @version 1.0
 * @copyright Loris Fariello - octobre 2019
 */
  
class controleurFilmListe extends controleur {
    private $modelFilm;
    private $nbSection;
    public function __construct() {
        $this->modelFilm = new modeleFilmListe();
    }
    /**
     * Met à jour le tableau $donnees de la classe mère avec les informations spécifiques de la page
     * @param null
     * @return null
     * @author Loris Fariello
     * @version 1.0
     */
    public function setDonnees() {
        
        $this->enteteLien = "<link rel='stylesheet' type='text/css' href='./css/tableau.css'/>\n";
        $this->enteteLien .= "<link rel='stylesheet' type='text/css' href='./css/navigation.css'/>\n";
        // ===============================================================================================================
        // titres de la page
        // ===============================================================================================================
        $this->titreHeader = "page d'accueil des films";
        $this->titreMain = "La liste des films de notre cinemathèque";
        
        
        
        // ===============================================================================================================
        // encarts
        // ===============================================================================================================
        $this->encartsGauche = $this->getEncart(1);
        // ===============================================================================================================
        // texte défilant
        // ===============================================================================================================
        // rien
        
        // ===============================================================================================================
        // alimentation galerie
        // ===============================================================================================================
        // Pas de galerie a generer
        
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
        $this->nbFilm = $this->modelFilm->getNbFilms();
        $this->nbFilmsSection = configuration::get("nbFilmParSection");
        
        $this->nbSections = maths::nbSection($this->nbFilm, $this->nbFilmsSection);
        $this->premierFilm = ($this->section - 1) * $this->nbFilmsSection + 1;
        $this->dernierFilm = ($this->section ==  $this->nbSections ? $this->nbFilm : $this->section * $this->nbFilmsSection);
        
        $this->films = $this->modelFilm->getAllFilms($this->premierFilm - 1, $this->nbFilmsSection);
        
        $this->navigation = $this->getNavigation();
        
        
        
        parent::genererVue();
    }
    
}

?>