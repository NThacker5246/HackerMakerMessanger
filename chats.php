<?php
	$chats = scandir("./chatlog");

	echo "<ul class=\"list-group\">";

	for ($i=0; $i < count($chats); $i++) {
		$name = $chats[$i];
		if(!is_dir("./chatlog/$name")){
			echo "<li class=\"list-group-item\" id=\"chat$i\" onclick=\"setchatVar();\">$name</li>";
		}
	}

	echo "</ul>";
?>