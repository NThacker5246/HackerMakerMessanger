var toId = "";
var temp = "";

var chat = "";
var ch = "";

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
	xhr.open('GET', './send.php?' + 'num=' + number + '&text=&chat=' + window.chat);

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

function setchatVar(e) {
	window.chat = e;
}

function UpdateChatList(dt) {
	var rsp = document.getElementById("chatsID");
	var xhr = new XMLHttpRequest();
	xhr.open('GET', './chats.php');

	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
			if(xhr.innerHTML != xhr.responseText) {
				rsp.innerHTML = xhr.responseText;
				if(dt == "first"){
					chat = rsp.childNodes[0].childNodes[0].innerHTML;
				}
			}
		}
	}

	xhr.send();
}

UpdateChatList("first");

setInterval(UpdateChatList, 1000);