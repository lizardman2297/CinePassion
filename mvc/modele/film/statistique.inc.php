<?php /**
 * Classe relative au modele de la page statistique
 * @author Loris Fariello
 * @version 1.0
 * @copyright Loris Fariello - decembre 2019
 */
class modeleFilmStatistique extends modeleFilm {
    
    public function getNbGenre() {
        $req = "SELECT COUNT(*) as nb
                FROM genre";
        $reqNb = $this->executerRequete($req);
        $nbGenre =  $reqNb->fetchObject();
        return $nbGenre->nb;
    }

    public function getNbFilmParGenre(){
        $req = "SELECT COUNT(*) AS nb, g.libelleGenre
                FROM genre g
                INNER JOIN film f
                ON g.numGenre = f.numGenreFilm
                GROUP BY g.numGenre";
        $reqNbGenre = $this->executerRequete($req);
        

        $lesGenre = new collection(true, $this->getNbGenre());
        while ($unGenre = $reqNbGenre->fetchObject()) {
            $lesGenre->ajouter(new statistique($unGenre->libelleGenre, $unGenre->nb));
        }
        return $lesGenre;
    }

    public function getFilmParaAnnee(){
        for ($i= configuration::get("dateDebut") ; $i <= 2019 ; $i++) { 
            $req = "SELECT COUNT(*) AS nb
                    FROM film
                    WHERE YEAR(dateSortieFilm) = $i";
            $reqFilm = $this->executerRequete($req);
            $annee[$i] = $reqFilm->fetchObject();
        }
        return $annee;
    }

}
?>

