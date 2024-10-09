var responseDiv = $('#otvet');

document.forms.fileF.onsubmit = function(e) {
	e.preventDefault();
	
	var userInput = document.forms.fileF.file.value;
	var formData = new FormData(this, document.getElementById('filesent'));

	const file = userInput[0];
	// Добавляем файл в запрос AJAX
	formData.append('file', file)

	var xhr = new XMLHttpRequest();
	
	xhr.open('POST', './file.php');
	

	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
			console.log(xhr.responseText)
			$('#otvet').innerHTML = xhr.responseText;
		}
	}

	xhr.send(formData);
}
