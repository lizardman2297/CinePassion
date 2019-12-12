function switchClass(event){
	var item = event.target;
	var oldActif = document.getElementsByClassName("itemActif");
	oldActif.item(0).classList.remove("itemActif")
	item.classList.add("itemActif");
}