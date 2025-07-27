const btn = document.getElementById('btn');
const nick = document.getElementById('nick');
const pass = document.getElementById('pass');

const resp = document.getElementById('resp');


btn.addEventListener("click", function(e) {
	if(nick.value != "" && pass.value != ""){
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "callback?dosstub=t&register=text&login=" + nick.value + "&pass=" + pass.value);
		xhr.onreadystatechange = function() {
			console.log(xhr.responseText);
			if(xhr.readyState == 4 && xhr.status == 200){
				switch(xhr.responseText){
					case "Login":
						document.cookie = "User=" + nick.value + "; max_age=5000; path=/;"
						console.log("Just a moment"); 
						location.href = "../index.html";
						break;
					case "Exist":
						resp.innerHTML = "User with name " + nick.value + "exists. You may want to login <a href=\"../login/index.html\">now</a>";
						break; 
				}
			}
		}
		xhr.send();
	} else {
		resp.innerHTML = "Write all lines";
	}
});