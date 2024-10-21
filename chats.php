<?php
	$serv = $_GET['serv'];
	$chats = scandir("./chatlog/$serv");

	echo "<ul class=\"list-group\">";

	for ($i=0; $i < count($chats); $i++) {
		$name = $chats[$i];
		if(!is_dir("./chatlog/$serv/$name")){
			echo "<li class=\"list-group-item\" id=\"chat$i\" onclick=\"setchatVar('$name');\">$name</li>";
		}
	}

	echo "</ul>";
?>