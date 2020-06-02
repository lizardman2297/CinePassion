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
        $mdpCrypt = $this->encrypte($motDePasseUser);

        $reqLogin = "SELECT COUNT(loginUser) AS nb FROM user where loginUser = '$loginUser'";
        $pdo = $this->executerRequete($reqLogin);

        if ($pdo->fetchObject()->nb == 1) {
            $reqMdp = "SELECT motDePasseUser FROM user WHERE loginUser = '$loginUser'";
            $pdoMdp = $this->executerRequete($reqMdp);
            $resultMdp = $pdoMdp->fetchObject()->motDePasseUser;
            if ($mdpCrypt == $resultMdp) {
                // $user = new stdClass();
                $user->mdp = $mdpCrypt;
                $user->login = $loginUser;
            }else {
                return false;
            }
        }else {
            return false;
        }
        var_dump($user);
        return $user;
    }
    
    /**
     * Met à jour le nombre d'échecs de connexion
     * @param string $loginUser : le login de l'utilisateur
     * @param string $operation : le type d'opération : "incrementer" ou "reinitialiser".
     * @return null
     */
    public function setNbEchecConnexionUser($loginUser, $operation){
        if ($operation == "incrementer") {
            $reqNbEchec = "UPDATE user SET nbEchecConnexionUser = nbEchecConnexionUser + 1 WHERE loginUser = $loginUser";
        }elseif ($operation == "reinitialiser") {
            $reqNbEchec = "UPDATE user SET nbEchecConnexionUser = 0 WHERE loginUser = $loginUser";
        }
        $nbEchec = $this->executerRequete($reqNbEchec);
    }

    /**
     * Met à jour le nombre total de connexions de l'utilisateur
     * @param string $loginUser : le login de l'utilisateur
     * @return null
     */
    public function setNbTotalConnexionUser($loginUser){
        $reqNbConnexion = "UPDATE user SET nbTotalConnexionUser = nbTotalConnexionUser + 1 WHERE loginUser = $loginUser ";
        $nbConnexion = $this->executerRequete($reqNbConnexion);
    }

    /**
     * Met à jour la date et l'heure de dernière connexion de l'utilisateur
     * @param string $loginUser : le login de l'utilisateur
     * @return null
     */
    public function setDateHeureDerniereConnexionUser($loginUser){
        $date = date('Y-n-d h:i:s');
        $reqDateConnexion = "UPDATE user SET dateHeureDerniereConnexionUser = $date";
        $dateConnexion = $this->executerRequete($reqDateConnexion);
    }


}