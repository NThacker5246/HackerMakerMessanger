var toId = "";
var temp = "";

var ch = "";
var sv = "";

var serv = "LocalServ";
var chat = "";

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

function call_act_file(id) {
	$("#action_file").modal("show");
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

function apply_file() {
	var act = document.getElementById('act');
	var val = act.options[act.selectedIndex].value;
	switch(val){
		case "del":
			remove(temp);
			temp = "";
			break;
	}

	$("#action_file").modal("hide");
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
	xhr.open('GET', './send.php?' + 'num=' + number + '&text=&chat=' + window.chat + '&serv=' + window.serv);

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
document.getElementById('actD').addEventListener("click", apply_file);

function setchatVar(e) {
	window.chat = e;
}

function servSet(e) {
	window.serv = e;
	UpdateChatList();
}

function UpdateServerList() {
	var rsp = document.getElementById("servID");
	var xhr = new XMLHttpRequest();
	xhr.open('GET', './servers.php');

	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
			if(sv != xhr.responseText) {
				rsp.innerHTML = xhr.responseText;
				sv = xhr.responseText;
				rsp.style.width = 100*rsp.childNodes.length + "px";
				rsp.parentNode.style.width = 100*rsp.childNodes.length + 70 + "px";
			}
		}
	}

	xhr.send();
}

function UpdateChatList(dt) {
	UpdateServerList();
	var rsp = document.getElementById("chatsID");
	var xhr = new XMLHttpRequest();
	xhr.open('GET', './chats.php?serv=' + serv);

	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
			if(ch != xhr.responseText) {
				rsp.innerHTML = xhr.responseText;
				ch = xhr.responseText;
				if(dt == "first"){
					window.chat = rsp.childNodes[0].childNodes[0].innerHTML;
				}
				document.getElementById('chatsID').childNodes[0].onclick();
			}
		}
	}

	xhr.send();
}

UpdateChatList("first");

setInterval(UpdateChatList, 1000);

const closes = document.getElementsByClassName('close');

for (var i = 0; i < closes.length; i++) {
	closes[i].onclick = function(e) {
		$("#serva").modal("hide");		
		$("#chat").modal("hide");	
		$("#action").modal("hide");
	}
}
