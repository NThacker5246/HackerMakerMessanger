<?php
	$chats = scandir("./chatlog");

	echo "<ul class=\"list-group\">";

	for ($i=0; $i < count($chats); $i++) {
		$name = $chats[$i];
		if(is_dir("./chatlog/$name")){
			if($name != "." && $name != "..") {
				echo "<li class=\"list-group-item\" id=\"chat$i\" onclick=\"servSet('$name');\">$name</li>";
			}
		}
	}

	echo "</ul>";
?>