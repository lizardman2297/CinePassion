<?php /**
 * Classe relative au modele commun a toutes les pages du site
 * @author Fariello Loris
 * @version 1.0
 * @copyright Fariello Loris - Janvier 2020
 */
class modeleUser extends modele {
    
    protected function encrypte($chaine){
        require_once('librairie/phpseclib/Crypt/RSA.php');
        $rsa = new Crypt_RSA();
        $rsa->loadKey('MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAKdoaos0Pcl+yz5pIr6KcucJ1jYr3F7YTZbfP7wbJ3uLTylgaW8nwJORR49Z+Sd7OesXwSXA8P8N3la6iceBgcsCAwEAAQ==');

        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $encrypt = $rsa->encrypt($chaine);
        return $encrypt;
    }
}
?>