function switchClass(event){
	var item = event.target;
	var oldActif = document.getElementsByClassName("itemActif");
	var idBlock = document.getElementById(item.innerHTML.toLowerCase());
	var oldBlock = oldActif.item(0).innerHTML.toLowerCase();
	document.getElementById(oldBlock).classList.remove("ongletActif");
	document.getElementById(oldBlock).classList.add("ongletNonActif");
	oldActif.item(0).classList.remove("itemActif");
	item.classList.add("itemActif");
	idBlock.classList.remove("ongletNonActif")
	idBlock.classList.add("ongletActif");
	console.log(oldActif.item(0).innerHTML.toLowerCase());
	
}