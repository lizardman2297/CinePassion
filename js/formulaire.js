function validationFormSub(){
    if (document.getElementById("login").value == "") {
        alert("tout les champs doivent etre renseigner");
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
        document.getElementById("badChar").innerHTML = "Charactere non autoriser";
        setTimeout("document.getElementById('badChar').innerHTML = ''", 500)
        return false;
    }
}