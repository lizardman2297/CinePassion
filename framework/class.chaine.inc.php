<?php 
/*================================================================================================================
	fichier				: class.chaine.inc.php
	auteur				: Loris Fariello
	date de création	: octobre 2019
	
	role				: decrit la classe permet tout les traitement lies au chaine de carractere
  ================================================================================================================*/

/**
 * classe permetant les traitement lies au chaine de carractere
 * @author Loris Fariello 
 * @version 1.0
 * @copyright Loris Fariello - octobre 2019
 *
 */
    class chaine {
 
        /**
         * convertie une chaine de carractere en ecriture camel en tableau de chaque "mot" 
         * @param string $uneChaine
         * @return array
         * @author Loris Fariello
         * @version 1.0
         * @copyright Loris Fariello - octobre 2019
         */
        static function decouper($uneChaine) {
            $result = preg_replace("([A-Z])", " $0", $uneChaine);
            $tab = explode(' ', $result);
            return $tab;
        }
        
    }

?>