<?php
	$serv = $_GET['serv'];
	$chats = scandir("./chatlog/$serv");

	//echo "<ul class=\"list-group\">";

	for ($i=0; $i < count($chats); $i++) {
		$name = $chats[$i];
		if(!is_dir("./chatlog/$serv/$name")){
			echo "<div class=\"v23_29\" id=\"chat$i\" onclick=\"setchatVar('$name');\">$name</div>";
		}
	}

	//echo "</ul>";
	echo "<button id=\"addch\" onclick=\"$('#chat').modal('show');\" class=\"v23_29\" type=\"button\" >Add Chat</button>"  
?>