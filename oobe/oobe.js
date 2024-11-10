

document.getElementById('upPF').onsubmit = function(e) {
	e.preventDefault();

	var formData = new FormData(document.forms.fileF);

	var xhr = new XMLHttpRequest();
	
	xhr.open('POST', './oobe.php');
	

	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
			console.log(xhr.responseText);
		}
	}

	xhr.send(formData);
}