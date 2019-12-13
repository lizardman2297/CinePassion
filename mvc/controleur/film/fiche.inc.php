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
        $this->nationaliteReal = $this->getNationaliteReal($this->leFilm);
        $this->typeFilm = $this->getTypeFilm($this->leFilm);
        $this->dureeHeures = $this->formatageHeure($this->leFilm->dureeHeures);
        $this->dateSortieFilm = $this->getDateSortie($this->leFilm);
        parent::genererVue();
    }
    
    /**
     * getGalerieImageImage
     *
     * @param  mixed $titreFilm
     *
     * @return void
     */
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
    
    /**
     * getNationaliteReal
     *
     * @param  mixed $unFilm
     *
     * @return void
     */
    private function getNationaliteReal($unFilm) {
        if ($unFilm->sexePersonne == "M") {
            return "du realisateur "  . lcfirst($unFilm->nationalitéM);
        } else{
            return "de la realisatrice "  . lcfirst($unFilm->nationalitéF);
        }
    }

    /**
     * getNationaliteFilm
     *
     * @param  mixed $unFilm
     *
     * @return void
     */
    private function getNationaliteFilm($unFilm){
        if ($unFilm->) {
            # code...
        }
    }
    
    /**
     * getTypeFilm
     *
     * @param  mixed $unFilm
     *
     * @return void
     */
    private function getTypeFilm($unFilm){
        switch ($unFilm->genre) {
            case "action":
                $type = "un film d'action";
            break;
            case "animation":
                $type = "un film d'animation";
            break;
            case "aventure":
                $type = "un film d'aventure";
            break;
            case "comédie":
                $type = "une comédie";
            break;
            case "documentaire":
                $type = "un documentaire";
            break;
            case "drame":
                $type = "un drame";
            break;
            case "épouvante/horreur":
                $type = "un film d'epouvante/horreur";
            break;
            case "érotique":
                $type = "un film érotique";
            break;
            case "fantastique":
                $type = "un film fantastique";
            break;
            case "guerre":
                $type = "un film de guerre";
            break;
            case "peplum":
                $type = "un peplum";
            break;
            case "policier":
                $type = "un film policier";
            break;
            case "science-fiction":
                $type = "un film de science-fiction";
            break;
            case "thriller":
                $type = "un thriller";
            break;
            case "western":
                $type = "un western";
            break;
            
            default:
                $type = "erreur";
            break;
        }
        return $type;
    }
    
    /**
     * formatageHeure
     *
     * @param  mixed $dureeHeure
     *
     * @return void
     */
    private function formatageHeure($dureeHeure){
        if ($dureeHeure < 10) {
            return substr($dureeHeure, 1);
        }
    }
    
    /**
     * getDateSortie
     *
     * @param  mixed $unFilm
     *
     * @return void
     */
    private function getDateSortie($unFilm){
        switch ($unFilm->mois) {
            case 1:
                $mois = "janvier ";
            break;
            case 2:
                $mois = "fevrier ";
            break;
            case 3:
                $mois = "mars ";
            break;
            case 4:
                $mois = "avril ";
            break;
            case 5:
                $mois = "mai ";
            break;
            case 6:
                $mois = "juin ";
            break;
            case 7:
                $mois = "juillet ";
            break;
            case 8:
                $mois = "aout ";
            break;
            case 9:
                $mois = "septembre ";
            break;
            case 10:
                $mois = "octobre ";
            break;
            case 11:
                $mois = "novembre ";
            break;
            case 12:
                $mois = "decembre ";
            break;
            default:
                $mois = "erreur ";
            break;
        }
        
        return $unFilm->jour . " " . $mois . $unFilm->annee;
    }
        
}
        
?>