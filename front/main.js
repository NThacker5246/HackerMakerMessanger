if(document.cookie == "") location.href = "/login/index.html";

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

const sel = document.getElementById('fileType');

const userlists = document.getElementById('users');

var chat = "";
var server = "LocalServ";

input.addEventListener("keydown", function(e) {
	//if enter taken
	if(input.value == "") return;
	if(e.keyCode == 13) send();
});

messa.addEventListener("click", send);


fila.addEventListener('click', function(event) {  
	const file1 = file.files[0];  
    if (!file1) return;

    const reader = new FileReader();  
    
    if (file1.type.startsWith('text/') || file1.type === 'application/json') {
        // Текстовые файлы читаем как текст
        reader.onload = function(e) {  
            sendFileData(e.target.result, true);
        };  
        reader.readAsText(file1);
    } else {
        // Бинарные файлы читаем как DataURL (base64)
        reader.onload = function(e) {  
            sendFileData(e.target.result.split(',')[1], false);
        };  
        reader.readAsDataURL(file1);
    }
});  

function sendFileData(data, isText) {
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "callback?server=" + server + "&chat=" + chat + "&type=" + sel.value + "&isBase64=" + (isText ? "0" : "1") + "&fname=" + file.value.substring(12) + "&data=" + data);
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200) output.innerHTML = decodeURIComponent(xhr.responseText);
	}
	xhr.send();		
}


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
	xhr.open("GET", "callback?server=" + server + "&chat=" + chat + "&sent=" + encodeURIComponent("<br>" + getcookie("User") + "> " + input.value));

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

function setcookie(name, data, date){
	document.cookie += name + "=" + data + ";" + "expires=" + date + "&"; 
}

function getcookie(param){
	var da = document.cookie.split("&");
	for (var i = 0; i < da.length; i++) {
		var kW = da[i].split("; ")[0].split("=");
		if(kW[0] == param) return kW[1];
	}
}

/*
function base64(toBase){
	var encode = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789#$+";
	for (var i = 0; i < toBase.length; i++) {
		toBase.charCodeAt(i);
	}
}
*/

function base64_encode(buffer) {
	var base = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
	var push = 0;
	var result = "";
	for (var i = 0; i < buffer.length; i++) {
		push |= buffer[i] << (i % 3) * 8;
		if((i % 3) == 2){
			var g1 = (push & 63);
			var g2 = ((push >> 6) & 63);
			var g3 = ((push >> 12) & 63);
			var g4 = ((push >> 18) & 63);
			result += base[g1] + base[g2] + base[g3] + base[g4];
			push = 0;
		}
	}
	return result;
}

function userlist() {
	var xhr = new XMLHttpRequest(); 
	xhr.open("GET", "callback?dosstub=1&userlist=ts"); 
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200){
			var array = xhr.responseText.substring(0, xhr.responseText.length-1).split(",");
			for (var i = 0; i < array.length; i++) {
				 	console.log(array[i]);
			 	array[i] = array[i].substring(6, array[i].length-5);
			 	userlists.innerHTML += "<div class=\"v22_18\">" + array[i] + "</div>";
			 	console.log(array[i]);
			}
			delete array; 
			delete xhr;
		}
	};
	xhr.send();
}

userlist();