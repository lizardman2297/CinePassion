<?php 
/*================================================================================================================
	fichier				: class.maths.inc.php
	auteur				: Loris Fariello
	date de création	: novembre 2019
	
	role				: decrit la classe permettant les fonctions mathematique
  ================================================================================================================*/

/**
 * classe permetant les traitement liés aux fonction de math
 * @author Loris Fariello 
 * @version 1.0
 * @copyright Loris Fariello - novembre 2019
 *
 */
    class maths {
 
        static function nbSection($nbFilms, $nbFilmsSection) {
            return ceil($nbFilms / $nbFilmsSection);
        }
        
    }

?>