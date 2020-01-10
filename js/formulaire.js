function validationFormSub(){
    if (document.getElementById("login").value == "" || document.getElementById("password").value == "") {
        alert("tout les champs doivent etre renseigner");
        document.getElementById("login").value = "";
        document.getElementById("password").value = "";
        document.getElementById("login").focus();
    }
}

function controlSaisie(){
    if (window.event.which >= 65 && window.event.which <= 90) { // Maj
		return true;
	}else if (window.event.which >= 97 && window.event.which <= 122) { // Min
		return true;
	}else if (window.event.which >= 48 && window.event.which <= 57) { // chiffre
		return true;
	}else if (window.event.which == 45 || window.event.which == 46 || window.event.which == 95) { // - .  _ 
        return true;
    }else{
        char = String.fromCharCode(window.event.which);
        document.getElementById("badChar").innerHTML = "Charactere " + char + " non autorisé";
        setTimeout("document.getElementById('badChar').innerHTML = ''", 700);
        return false;
    }
}