document.getElementById('chAdd').addEventListener("click", function(e) {
	var name = document.getElementById('chatName').value;

	var xhr = new XMLHttpRequest();
	xhr.open('GET', './chatAdd.php?name=' + name + "&serv=" + window.serv);

	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
			$("#chat").modal('hide');
		}
	}

	xhr.send();
});

/*
document.getElementById('addch').addEventListener("click", function(e) {
	$("#chat").modal('show');
});

*/



document.getElementById('svAdd').addEventListener("click", function(e) {
	var name = document.getElementById('svName').value;

	var xhr = new XMLHttpRequest();
	xhr.open('GET', './servAdd.php?name=' + name);

	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
			$("#serva").modal('hide');
		}
	}

	xhr.send();
});

/*

document.getElementById('addsv').addEventListener("click", function(e) {
	$("#serva").modal('show');
});

*/