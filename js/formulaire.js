function validationFormSub(){
    if (document.getElementById("login").value == "") {
        document.getElementById("badChar").innerHTML = "Le login doit etre renseigner";
        setTimeout("document.getElementById('badChar').innerHTML = ''", 700);
    }else if (document.getElementById("password").value == ""){
        document.getElementById("badChar").innerHTML = "Le mot de passe doit etre renseigner";
        setTimeout("document.getElementById('badChar').innerHTML = ''", 700);
    }else{
        if (verifierAuthentificationUser()) {
            document.getElementById("formCo").submit();
        }
    }
}


/**
 * Chiffrement des informations du formulaire d'authentification
 * @return true (le formulaire sera envoyé) ou false (le formulaire ne sera pas envoyé)
 */
function verifierAuthentificationUser() {
    var jse = new JSEncrypt();
    var login = document.getElementById("login").value;
    var mdp = document.getElementById("password").value;
    var publicKey = publicKeyRsa;
    
    jse.setPublicKey(publicKey);
    
    var loginHash = jse.encrypt(login);
    var mdpHash = jse.encrypt(mdp);
    
    // login = loginHash;
    // mdp = mdpHash;
    
    // alert(mdp);
    
    return true;
    
}


/**
 * Verifie si les caractere selectionné sont autoriser (en temps reel)
 */
function controlSaisie(){
    if (document.getElementById("login").value.length > 20 || document.getElementById("password").value.length > 20) {
        document.getElementById("badChar").innerHTML = "Nombre de charactere max atteint";
        setTimeout("document.getElementById('badChar').innerHTML = ''", 700);
        return false;
    }

    if (window.event.which >= 65 && window.event.which <= 90) { // Maj
        return true;
    }else if (window.event.which >= 97 && window.event.which <= 122) { // Min
        return true;
    }else if (window.event.which >= 48 && window.event.which <= 57) { // chiffre
        return true;
    }else if (window.event.which == 45 || window.event.which == 46 || window.event.which == 95) { // - .  _ 
        return true;
    }else if (window.event.which == 13){
        validationFormSub();
    }else{
        char = String.fromCharCode(window.event.which);
        document.getElementById("badChar").innerHTML = "Charactere " + char + " non autorisé";
        setTimeout("document.getElementById('badChar').innerHTML = ''", 700);
        return false;
    }
}