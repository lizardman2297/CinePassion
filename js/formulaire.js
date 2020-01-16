function validationFormSub(){
    if (document.getElementById("login").value == "") {
        document.getElementById("badChar").innerHTML = "Le login doit etre renseigner";
        setTimeout("document.getElementById('badChar').innerHTML = ''", 700);
    }else if (document.getElementById("password").value == ""){
        document.getElementById("badChar").innerHTML = "Le mot de passe doit etre renseigner";
        setTimeout("document.getElementById('badChar').innerHTML = ''", 700);
    }else{
        document.getElementById("formCo").submit();
    }
}

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




newFunction();
function newFunction() {
    var jse = new JSEncrypt();
    jse.setPublicKey("MIICITANBgkqhkiG9w0BAQEFAAOCAg4AMIICCQKCAgBghaDFmV3uO+obJS5JzTaQuapf9zAdCpvhenzqjeJBahAPD7k7XsQWCiXe2NJ0yitvLECtqGqSZM+YJirZTGtvtlZ34vMuz/Wj7lyZploiFCi7VHAwSQIoWIXj2gNuFC9fneRh7VskdfYDkFzYNe9XqaCC/UTQv7ARsIVXkaHs0jR0v8etKq8p6/gqqWCCy6Uq/RgB3KPlN83ROcXFMoHD75lRitnqfC5LKwrHw7qokmNbrQ967Jl7Uxw2Gnm/+hqlDNHq8L9QwkWDbSZaPIlfwS32N0w2xsaZmLeVM2dj9zqvVGOco2KwxrRj+Hvr6HVx6KNbORIjaksGZurXtehrZfDb3viE+tekcnMYzPGfg4/M99Lhxvd1//V/pJv0AnE6RAJJKGx8MS75Oh8e2+cN7p/u3grgtfa6YYdv/Qe8phgHgBtL/NlWQara41eEcsgJPJoeyg04CPMrFEG+J0TTlFSlFXTxt4zXfJ7sJzJ8+MmYFIV0Sy9BOhVhPxIqTyUcTVWQzTaa9PKB8API2/bnMRtypwTy2M1Iv3C/lKS/BLn09aXS2rct9M8AH7QKksVkMN7zYp3HcOp4q4E17nBRWczJkDh/AHQbW6K3+FdtlGa/MRi4V1kyohQEAw4V/4QKlXRITENYPqA+7rsgTxEowDS9+7s4MQGMuXued1/3ZQIDAQAB");
    var test = jse.encrypt("voila jkfds");
    jse.setPrivateKey("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");
    var test2 = jse.decrypt(test);
    console.log(test);
    console.log(" ---- ");
    console.log(test2);
}

