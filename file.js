var responseDiv = $('#otvet');
var c_in = document.getElementById('chat1');
var s_in = document.getElementById('serv1');


document.forms.fileF.onsubmit = function(e) {
	e.preventDefault();

	c_in.value = window.chat;
	s_in.value = window.serv;
	
	var userInput = document.forms.fileF.file.value;
	var formData = new FormData(document.forms.fileF);

	//const file = userInput[0];
	// Добавляем файл в запрос AJAX
	//formData.append('file', file);

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
