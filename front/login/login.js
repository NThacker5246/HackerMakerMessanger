const btn = document.getElementById('btn');
const nick = document.getElementById('nick');
const pass = document.getElementById('pass');
		
//GPA
const G = 831;
const P = 465;

btn.addEventListener("click", function(e) {
	if(nick.value != "" && pass.value != ""){
		//login
		//generate key
		//var A = (G ** rand()) % P;
		//var xhr = new XMLHttpRequest();
		//xhr.open("GET", "callback?generateB";
		document.cookie = "User=" + nick.value + "; max_age=5000; path=/;"
		console.log("test"); 
		location.href = "../index.html";
	}
});
/*
function setcookie(name, data, date){
	document.cookie = name + "=" + data + ";" + "max_age=" + date + "path=/;"; 
}
*/