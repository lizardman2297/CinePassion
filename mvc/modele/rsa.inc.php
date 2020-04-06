<?php /**
 * Classe relative au chiffrement rsa
 * @author Fariello Loris
 * @version 1.0
 * @copyright Fariello Loris - Janvier 2020
 */
class modeleRsa extends modele{
    /**
     * Récupère la clé publique RSA
     * @param integer $num : le numéro du couple de clé RSA
     * @return string : la clé publique du couple de clé RSA dont le numéro est passé en paramètre
     */
    public function getPublicKeyRsa($num){
        $req = "SELECT publicKeyRsa FROM rsa WHERE = ?";
        $pdo = $this->executerRequete($req, $num);
        return $result = $pdo->fetchObject();
    }

    /**
     * Récupère la clé privée RSA
     * @param integer $num : le numéro du couple de clé RSA
     * @return string : la clé privée du couple de clé RSA dont le numéro est passé en paramètre 
     */
    public function getPrivateKeyRsa($num){
        $req = "SELECT privateKeyRsa FROM rsa WHERE = ?";
        $pdo = $this->executerRequete($req, $num);
        return $result = $pdo->fetchObject();
    }

}
?>