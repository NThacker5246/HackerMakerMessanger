var responseDiv = $('#otvet');
var resp = document.getElementById('otvet');
var input = document.getElementById('inpText');
var otv = "";
var flag = true;
var fileInp = document.getElementById('file');

document.forms.address.onsubmit = function(e) {
	if(e != "update"){
		if (e != null) {
			e.preventDefault();
		}

		var userInput = document.forms.address.message.value;
		userInput = encodeURIComponent(userInput);

		if(fileInp.value != null){
			console.log("Not null");
			document.forms.fileF.onsubmit();
		}

		var xhr = new XMLHttpRequest();
		if(toId != ""){
			xhr.open('GET', './send.php?' + 'text=' + userInput + '&num=' + toId + '&chat=' + window.chat + '&serv=' + window.serv);
			

			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4 && xhr.status === 200 && window.otv != xhr.responseText) {
					//console.log(xhr.responseText)
					responseDiv.html(xhr.responseText);
					resp.scrollTo(0, resp.scrollHeight);
					input.value = "";
				}
			}

			toId = "";
		} else {
			xhr.open('GET', './send.php?' + 'text=' + userInput + '&num=' + '&chat=' + window.chat + '&serv=' + window.serv);
			

			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4 && xhr.status === 200 && window.otv != xhr.responseText) {
					//console.log(xhr.responseText)
					responseDiv.html(xhr.responseText);
					resp.scrollTo(0, resp.scrollHeight);
					input.value = "";
				}
			}
		}

		xhr.send();
	} else {
		var xhr = new XMLHttpRequest();
		
		xhr.open('GET', './send.php?' + 'text=&num=' + '&chat=' + window.chat + '&serv=' + window.serv);
		

		xhr.onreadystatechange = function() {
			if (flag && xhr.readyState === 4 && xhr.status === 200 && window.otv != xhr.responseText) {
				responseDiv.html(xhr.responseText);
				window.otv = xhr.responseText;
				flag = false;
				resp.scrollTo(0, resp.scrollHeight);
			}
		}

		xhr.send();
	}
}

function update() {
	document.forms.address.onsubmit("update");
	flag = true;
}

update();

setInterval(update, 1000);