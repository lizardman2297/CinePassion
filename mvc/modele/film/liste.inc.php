<?php /**
 * Classe relative au modele de la page liste
 * @author Loris Fariello
 * @version 1.0
 * @copyright Loris Fariello - Octobre 2019
 */
class modeleFilmListe extends modeleFilm {
    
    /**
     * Renvoi une collection de l'ensemble des films 
     * @return collection
     * @author Loris Fariello
     * @version 1.1
     * @copyright Loris Fariello - octobre 2019
     */
    public function getAllFilms($debut, $nb) {
        $lesFilms = new collection(true, $this->getNbFilms());
        $req = "SELECT numFilm, titreFilm, TIME_FORMAT(dureeFilm, '%H:%i') AS duree, YEAR(dateSortieFilm) AS annee, libelleGenre AS genre, prenomPersonne AS prenomRealisateur,
                nomPersonne AS nomRealisateur
                FROM film 
                INNER JOIN genre
                ON film.numGenreFilm = genre.numGenre
                INNER JOIN realisateur
                ON film.numRealisateurFilm = realisateur.numRealisateur
                INNER JOIN personne
                ON realisateur.numRealisateur = personne.numPersonne
                ORDER BY titreFilm ASC
                LIMIT $debut, $nb;" ;       
        $films = $this->executerRequete($req);
        while ($unFilm = $films->fetchObject()) {
            $totalFilms[] = $unFilm;
        }

        foreach ($totalFilms as $unFilm) {
            $lesFilms->ajouter($unFilm);
        }
        return $lesFilms;
    }
}
?>

