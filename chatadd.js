document.getElementById('chAdd').addEventListener("click", function(e) {
	var name = document.getElementById('chatName').value;

	var xhr = new XMLHttpRequest();
	xhr.open('GET', './chatAdd.php?name=' + name);

	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
			$("#chat").modal('hide');
		}
	}

	xhr.send();
});

document.getElementById('addch').addEventListener("click", function(e) {
	$("#chat").modal('show');
});
