<?php /**
* Classe relative au modele commun a toutes les pages du site
* @author Loris Fariello
* @version 1.1
* @copyright Loris Fariello - Octobre 2019
*/
class modeleFilm extends modele{
    /**
     * Retourne le nombre de film total dans la base de donnee
     * @author Loris Fariello
     * @return int : nombre de film
     * @copyright Loris Fariello - Octobre 2019
     */
    public function getNbFilms() {
        $req = "SELECT COUNT(*) AS nb FROM film";
        $reqFilm = $this->executerRequete($req);
        $nbFilm = $reqFilm->fetchObject();
        return $nbFilm->nb;
    }
    
   
    
}
?>