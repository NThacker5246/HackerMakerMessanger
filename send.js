var responseDiv = $('#otvet');
var resp = document.getElementById('otvet');
var otv = "";
//otv.scrollTo(0, otv.scrollHeight);

document.forms.address.onsubmit = function(e) {
	if(e != "update"){
		if (e != null) {
			e.preventDefault();
		}
		var userInput = document.forms.address.message.value;
		userInput = encodeURIComponent(userInput);

		var xhr = new XMLHttpRequest();
		
		xhr.open('GET', './send.php?' + 'text=' + userInput);
		

		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				console.log(xhr.responseText)
				responseDiv.html(xhr.responseText);
			}
		}

		xhr.send();
		var otv = document.getElementById('otvet')
		otv.scrollTo(0, otv.scrollHeight);
	} else {
		var xhr = new XMLHttpRequest();
		
		xhr.open('GET', './send.php?' + 'text=');
		

		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				if(window.otv != xhr.responseText){
					responseDiv.html(xhr.responseText);
					window.otv = xhr.responseText;
				}
			}
		}

		xhr.send();
	}
}

function update() {
	document.forms.address.onsubmit("update");
}

update();

setInterval(update, 1000);