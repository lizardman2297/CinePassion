<?php /**
 * Classe relative au modele commun a toutes les pages du site
 * @author Fariello Loris
 * @version 1.0
 * @copyright Fariello Loris - Janvier 2020
 */
class modeleUser extends modele {
    
    protected function encrypteString($chaine){
        require_once('librairie/phpseclib/Crypt/RSA.php');
        $rsa = new Crypt_RSA();
        $rsa->loadKey('MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAKdoaos0Pcl+yz5pIr6KcucJ1jYr3F7YTZbfP7wbJ3uLTylgaW8nwJORR49Z+Sd7OesXwSXA8P8N3la6iceBgcsCAwEAAQ=='); //public key

        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $encrypt = $rsa->encrypt($chaine);
        return $encrypt;
    }

    protected function decrypteString($chaine){
        require_once('librairie/phpseclib/Crypt/RSA.php');
        $rsa = new Crypt_RSA();
        $rsa->loadKey('MIGqAgEAAiEAlmj5JG8CQ5m9iqJZmMiz+FtO9xUbbhZaoTNUuITTr/MCAwEAAQIgDQrWNm66eLJ/SThcYjoJF5OTsahQBwM4DFOu0fhiob0CEQDf3QKk1J3qjGfjlgS5B6d/AhEArACNE2T5H6W7MHmbXQMRjQIQCzGU6UMMZmcA5ttgfxQH5wIRAJUESTVTVs6HXHzr7qGPxgUCEGSOeBjBaD5W9h5TCoVTg+c='); // private key

        $decrypte = $rsa->decrypt($chaine);
        return $decrypte;
    }
}
?>