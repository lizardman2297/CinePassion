<?php 
/*======= C O N T R O L E U R ====================================================================================
	fichier				: ./mvc/controleur/film/fiche.inc.php
	auteur				: Fariello  Loris
	date de création	: novembre 2019
	date de modification:
	rôle				: le contrôleur de la page statistique
  ================================================================================================================*/

/**
 * Classe relative au contrôleur de la page statistique
 * @author Fariello Loris
 * @version 1.0
 * @copyright Fariello loris - decembre 2019
 */
  
class controleurFilmStatistique extends controleur {
    private $modelFilm;

    
    public function __construct() {
        $this->modelFilm = new modeleFilmStatistique();
    }
    public function setDonnees() {
        
               
        $this->enteteLien = "<link rel='stylesheet' type='text/css' href='./css/stat.css'/>\n";
        $this->enteteLien .= "<script type='text/javascript' src='./js/appFiche.js'></script>\n";
        // ===============================================================================================================
        // titres de la page
        // ===============================================================================================================
        $this->titreHeader = "Les statistiques des films";
        $this->titreMain = "Les statistiques des films";
        
        
        // ===============================================================================================================
        // encarts
        // ===============================================================================================================
        $this->encartsGauche = $this->getEncart(1);
        $this->encartsDroite = $this->getEncart(1);
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
        $this->nbGenre = $this->modelFilm->getNbGenre();
        $this->totalFilm = $this->modelFilm->getNbFilms();
        $this->collGenre = $this->modelFilm->getNbFilmParGenre();
        $this->filmParAnnee = $this->modelFilm->getFilmParaAnnee();
        parent::genererVue();
    }
    
   
        
}
        
?>