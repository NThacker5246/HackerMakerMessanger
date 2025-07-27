const btn = document.getElementById('btn');
const nick = document.getElementById('nick');
const pass = document.getElementById('pass');

const resp = document.getElementById('resp');
		
//GPA
const G = 831;
const P = 465;

btn.addEventListener("click", function(e) {
	if(nick.value != "" && pass.value != ""){
		//login
		//generate key
		//var A = (G ** rand()) % P;
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "callback?dosstub=t&login=" + nick.value + "&pass=" + pass.value);
		xhr.onreadystatechange = function() {
			if(xhr.readyState == 4 && xhr.status == 200){
				switch(xhr.responseText){
					case "Login succeeful":
						document.cookie = "User=" + nick.value + "; max_age=5000; path=/;"
						console.log("Just a moment"); 
						location.href = "../index.html";
						break;
					case "User not found":
						resp.innerHTML = "User with name " + nick.value + " not found. Would you like register <a href=\"../register/index.html\">now</a>?";
						break;
					case "Password incorrect":
						resp.innerHTML = "Password incorrect, try again or escalate your privilegies :), if you can.";
						break;
				}
			}
		}
		xhr.send();
	} else {
		resp.innerHTML = "Write all lines)";
	}
});

