<?php /**
 * Classe relative au modele de la page fiche
 * @author Loris Fariello
 * @version 1.0
 * @copyright Loris Fariello - Octobre 2019
 */
class modeleFilmFiche extends modeleFilm {
    public function getTitreFilm($numFilm) {
        $req = "SELECT titreFilm FROM film WHERE numFilm = '$numFilm'";
        $reqTitre = $this->executerRequete($req);
        $titre = $reqTitre->fetchObject();
        return $titre->titreFilm;
    }
    
    /**
     * getInfoFilm
     *
     * @param  mixed $numFilm
     *
     * @return void
     */
    public function getInfoFilm($numFilm) {
        $req = "SELECT numFilm, titreFilm,TIME_FORMAT(dureeFilm, '%H') AS dureeHeures, TIME_FORMAT(dureeFilm, '%i') AS dureeMinutes, 
                DAY(dateSortieFilm) AS jour, MONTH(dateSortieFilm) AS mois, YEAR(dateSortieFilm) AS annee, libelleGenre AS genre, 
                prenomPersonne AS prenomRealisateur, nomPersonne AS nomRealisateur, synopsisFilm AS synopsis, 
                p1.libellePays AS pays,
                p2.libellePays AS paysReal,
                p1.nationalitéM, p1.nationalitéF, sexePersonne
                FROM film 
                INNER JOIN genre
                ON film.numGenreFilm = genre.numGenre
                INNER JOIN realisateur
                ON film.numRealisateurFilm = realisateur.numRealisateur
                INNER JOIN personne
                ON realisateur.numRealisateur = personne.numPersonne
                INNER JOIN pays p1
                ON film.numPaysFilm = p1.numPays
                INNER JOIN pays p2
                ON personne.numPaysPersonne = p2.numPays
                WHERE numFilm = $numFilm";
        $reqInfo = $this->executerRequete($req);
        $infoFilm = $reqInfo->fetchObject();
        return $infoFilm;
    }
    
    /**
     * getPositionFilm
     *
     * @param  mixed $nomFilm
     *
     * @return void
     */
    public function getPositionFilm($nomFilm) {
        $position = "";
        $req = "SELECT COUNT(titreFilm) AS position
                FROM film
                INNER JOIN realisateur
                ON realisateur.numRealisateur = film.numRealisateurFilm
                INNER JOIN personne
                ON personne.numPersonne = realisateur.numRealisateur
                WHERE film.numRealisateurFilm = (SELECT film.numRealisateurFilm FROM film WHERE film.titreFilm = '$nomFilm')
                AND film.dateSortieFilm <= (SELECT film.dateSortieFilm FROM film WHERE film.titreFilm = '$nomFilm')
                ORDER BY film.dateSortieFilm;";
        $reqPos = $this->executerRequete($req);
        $positionFilm = $reqPos->fetchObject();
        if ($positionFilm->position == 1) {
            $position = "premier film";
        }else {
            $position = $positionFilm->position . "<sup>eme</sup> film";
        }
        return $position;
    }
    
   
}
?>