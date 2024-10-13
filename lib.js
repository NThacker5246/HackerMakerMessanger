var toId = "";
var temp = "";

function copy(id) {
	var elem = document.getElementById(id);
	elem.select();
	document.execCommand("copy");
	alert("Copied!");
}

function call_act(id) {
	$("#action").modal("show");
	temp = id;
}

function apply() {
	var act = document.getElementById('act');
	var val = act.options[act.selectedIndex].value;
	switch(val){
		case "del":
			remove(temp);
			temp = "";
			break;
		case "edi":
			edit(temp);
			temp = "";
			break;
	}

	$("#action").modal("hide");
}

function edit(id) {
	console.log(document.getElementById(id));
	var number = id;
	number = number.replace('m', '');
	toId = number;
}

function remove(id) {
	var number = id;
	number = number.replace('m', '');

	var xhr = new XMLHttpRequest();
	xhr.open('GET', './send.php?' + 'num=' + number + '&text=');

	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
			//console.log(xhr.responseText)
			responseDiv.html(xhr.responseText);
			resp.scrollTo(0, resp.scrollHeight);
		}
	}

	xhr.send();
	
}

document.getElementById('actB').addEventListener("click", apply);