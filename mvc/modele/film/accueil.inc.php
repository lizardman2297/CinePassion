<?php /**
 * Classe relative au modele commun a toutes les pages du site
 * @author Mathias MASSELON
 * @version 1.0
 * @copyright Mathias Masselon - Septembre 2019
 */
class modeleFilmAccueil extends modeleFilm {
    
    /**
     * renvoi le numero du film passer en param'
     * @param string $titreFilm : le titre du film
     * @return int le numero du film
     * @version 1.0
     * @author Loris Fariello
     * @copyright Loris Fariello - octobre 2019
     */
    public function getNumFilm($titreFilm) {
        $req = "SELECT numFilm FROM film WHERE titreFilm = \"$titreFilm\"";
        $reqNum = $this->executerRequete($req);
        $num = $reqNum->fetchObject();
        return $num->numFilm;
    }
    
    /**
     * Trouve le titre du film en fonction de son numero
     * @param int $numFilm : le numero du film
     * @return string : le titre du film
     * @version 1.0
     * @author Loris Fariello
     * @copyright Loris Fariello - octobre 2019
     */
    public function getTitreFilm($numFilm) {
        $req = "SELECT titreFilm FROM film WHERE numFilm = '$numFilm'";
        $reqTitre = $this->executerRequete($req);
        $titre = $reqTitre->fetchObject();
        return $titre->titreFilm;
    }
}
?>