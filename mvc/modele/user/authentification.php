<?php
/**
 * Classe relative au modele de la page authentification du module user
 * @author Fariello Loris
 * @version 1.0
 * @copyright Fariello Loris - Avril 2020
 */
class modeleUserAuthentification extends modeleUser{
    
    /**
    * renvoie un objet anonyme comportant les informations sur l'utilisateur qui vient de
    * s'authentifier ou le booléan false si la tentative d'authentification se solde par un
    * échec.
    * @param string $loginUser : le login de l'utilisateur
    * @param string $motDePasseUser : le mot de passe de l'utilisateur
    * @return object : un objet anonyme comportant les informations sur l'utilisateur qui vient
    * de s'authentifier (si son login et son mot de passe sont bons). Le booléen false est
    * renvoyé si le login et/ou le mot de passe sont incorrects (car la méthode fetch renvoie le
    * booléen false lorsqu'il n'y a plus de tuples à lire)
    */
    public function getInformationsUser($loginUser, $motDePasseUser){
        
    }
    
}