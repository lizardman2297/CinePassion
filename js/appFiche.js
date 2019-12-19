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
}

function switchClassStat(event) {
	var item = event.target; // item clicker

	var actifCourant = document.getElementsByClassName("itemActif");
	var oldBlock = document.getElementsByClassName("ongletNonActif");
	var currentBlock = document.getElementsByClassName("ongletActif");




	oldBlock.item(0).classList.add("ongletActif");
	oldBlock.item(0).classList.remove("ongletNonActif");

	currentBlock.item(0).classList.add("ongletNonActif");
	currentBlock.item(0).classList.remove("ongletActif");


	actifCourant.item(0).classList.remove("itemActif");
	item.classList.add("itemActif");

}