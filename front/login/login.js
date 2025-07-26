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
		var d = new Date();
		d.setTime(Date.now() + 5000000);
		setcookie("User", nick.value, d);
		//location.href = "../index.html";
	}
});
function setcookie(name, data, date){
	document.cookie += name + "=" + data + ";" + "expires=" + date.toUTCString(); 
}