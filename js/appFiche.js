function switchClass(event){
	var item = event.target; // item clicker
	var oldActif = document.getElementsByClassName("itemActif"); //onglet courant
	var blockSuivant = document.getElementById(item.innerHTML.toLowerCase()); // block de texte a afficher
	var oldBlock = oldActif.item(0).innerHTML.toLowerCase(); // block texte courant
	document.getElementById(oldBlock).classList.remove("ongletActif");
	document.getElementById(oldBlock).classList.add("ongletNonActif");
	oldActif.item(0).classList.remove("itemActif");
	item.classList.add("itemActif");
	blockSuivant.classList.remove("ongletNonActif")
	blockSuivant.classList.add("ongletActif");
	console.log(oldActif.item(0).innerHTML.toLowerCase());
	
}