<?php 
/*======= C O N T R O L E U R ====================================================================================
	fichier				: ./mvc/controleur/film/fiche.inc.php
	auteur				: Mathias Masselon
	date de création	: novembre 2019
	date de modification:
	rôle				: le contrôleur de la page fiche des films
  ================================================================================================================*/

/**
 * Classe relative au contrôleur de la page liste du domaine fiche descriptive
 * @author Mathias Masselon
 * @version 1.0
 * @copyright Mathias Masselon - novembre 2019
 */
  
class controleurFilmFiche extends controleur {
    private $modelFilm;

    
    public function __construct() {
        $this->modelFilm = new modeleFilmFiche();
    }
    public function setDonnees() {
        
        $this->titreFilmCourant = $this->modelFilm->getTitreFilm($this->requete->getParametre("section"));
        
        $this->enteteLien = "<link rel='stylesheet' type='text/css' href='./css/fiche.css'/>\n";
        $this->enteteLien .= "<link rel='stylesheet' type='text/css' href='./librairie/lightbox/css/lightbox.css'/>\n";
        $this->enteteLien .= "<script type='text/javascript' src='./js/appFiche.js'></script>\n";
        $this->enteteLien .= "<script type='text/javascript' src='./librairie/jquery/jquery1.7.2.js'></script>\n";
        $this->enteteLien .= "<script type='text/javascript' src='./librairie/lightbox/js/lightbox.js'></script>\n";
        // ===============================================================================================================
        // titres de la page
        // ===============================================================================================================
        $this->titreHeader = $this->titreFilmCourant;
        $this->titreMain = "La description de : " . $this->titreFilmCourant;
        
        
        
        // ===============================================================================================================
        // encarts
        // ===============================================================================================================
//         $this->encartsGauche = $this->getEncart(1);
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
        $this->leFilm = $this->modelFilm->getInfoFilm($this->requete->getParametre("section"));
        $this->positionFilm = $this->modelFilm->getPositionFilm($this->leFilm->titreFilm);
        $this->galerieImageFilm = $this->getGalerieImageImage($this->leFilm->titreFilm);
        parent::genererVue();
    }
    
    private function getGalerieImageImage($titreFilm) {
        $dirImage = scandir("./image/film/photo/" . $titreFilm);
        $tabImage = array();
        foreach ($dirImage as $element) {
            if ($element == "." || $element == ".." || pathinfo($element, PATHINFO_EXTENSION) == "db") {
                //                 on en fait rien 
            }elseif(pathinfo($element, PATHINFO_EXTENSION) == "jpg"){
                $tabImage[] = $element;
            }
            
        }
        $image = "<a href='./image/film/photo/$titreFilm/$tabImage[0]' rel='lightbox[film]'><img alt='affiche' src='./image/film/affiche/$titreFilm.jpg' class='imageFilm'></a>";
        for ($i = 1; $i < count($tabImage); $i++) {
            $image .= "<a href='./image/film/photo/$titreFilm/$tabImage[$i]' rel='lightbox[film]'></a>";
        }
        return $image;
    }
    
    private function getNationalite($pays) {
        
    }
        
}
        
?>