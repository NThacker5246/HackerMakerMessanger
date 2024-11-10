var flagH = true;
var card = document.getElementById('profile');

function swap(e) {
	flagH = !flagH;
	if(flagH){
		document.getElementById('profile').style.display = "flex";
		sentPF(e.target.getAttribute("value"));
	} else {
		document.getElementById('profile').style.display = "none";
	}
}

const pb = document.getElementsByClassName('pb');

for (var i = 0; i < pb.length; i++) {
	pb[i].onclick = swap;
}

function sentPF(name) {
	var xhr = new XMLHttpRequest();

	xhr.open('GET', './getPFName.php?' + 'name=' + name);

	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200 && window.otv != xhr.responseText) {
			card.innerHTML = xhr.responseText;
		}
	}

	xhr.send();
}

swap();