function copy(id) {
	var elem = document.getElementById(id);
	elem.select();
	document.execCommand("copy");
	alert("Copied!");
}