//InputOutput system
const input = document.getElementById('messa');
const output = document.getElementById('resp');
const file = document.getElementById('file');
//buttons
const messa = document.getElementById('tsend');
const fila = document.getElementById('fsend');
//chat&server
const chats1 = document.getElementById('chats');
const addch = document.getElementById('addch');
const nc = document.getElementById('nc');

const server1 = document.getElementById('servers');
const addsv = document.getElementById('addsv');
const ns = document.getElementById('ns');

var chat = "";
var server = "LocalServ";

input.addEventListener("keydown", function(e) {
	//if enter taken
	if(input.value == "") return;
	if(e.keyCode == 13) send();
});

messa.addEventListener("click", send);

fila.addEventListener('click', function(event) {  
	const file1 = file.files;  
	const reader = new FileReader();  
	reader.onload = function(e) {  
		//document.getElementById('textOutput').innerHTML = e.target.result;
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "callback?server=" + server + "&chat=" + chat + "&fname=" + file.value.substring(12) + "&data=" + encodeURIComponent(e.target.result));
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200) output.innerHTML = decodeURIComponent(xhr.responseText);
		}
		xhr.send();
	};  
	reader.readAsText(file1[0]);
});  

function readAll() {
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "callback?server=" + server + "&chat=" + chat + "&readall");
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) output.innerHTML = decodeURIComponent(xhr.responseText);
	}
	xhr.send();
}

function send() {
	//otvet
	//output.innerHTML += "<br>" + input.value;
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "callback?server=" + server + "&chat=" + chat + "&sent=" + encodeURIComponent("<br>User#0001> " + input.value));

	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) output.innerHTML = decodeURIComponent(xhr.responseText);
	};
	xhr.send();
	//Clean for simple usage
	input.value = "";

}

function addChats() {
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "callback?server=" + server + "&getchats");

	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) chats1.innerHTML = xhr.responseText;
		var chats = document.getElementsByClassName('chat');
		for (var i = 0; i < chats.length; i++) {
			chats[i].addEventListener("click", function(e) {
				chat = e.target.innerHTML;
				readAll();
				chats1.style.height = 90 * chats1.childNodes.length + "px";
			});
		}	
	};
	xhr.send();	
}
addChats();

addch.addEventListener("click", function(e) {
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "callback?server=" + server + "&newchat=" + nc.value);
	xhr.onreadystatechange = function() { 
		if(xhr.readyState == 4) addChats(); 
	}
	xhr.send();
});

function addServers() {
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "callback?getservers");

	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) {
			server1.innerHTML = xhr.responseText;
			server1.style.width = 90 * server1.childNodes.length + "px";
		}
		var servers = document.getElementsByClassName('serv');
		for (var i = 0; i < servers.length; i++) {
			servers[i].addEventListener("click", function(e) {
				server = e.target.innerHTML;
				addChats();
				chat = "";
			});
		}	
	};
	xhr.send();	
}

addServers();

addsv.addEventListener("click", function(e) {
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "callback?newserver=" + ns.value);
	xhr.onreadystatechange = function() { 
		if(xhr.readyState == 4) addServers(); 
	}
	xhr.send();
});

setInterval(readAll, 10000);
setInterval(addChats, 100000);
setInterval(addServers, 100000);
