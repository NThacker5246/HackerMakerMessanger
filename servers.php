<?php
	$chats = scandir("./chatlog");

	//echo "<ul class=\"list-group\">";

	for ($i=0; $i < count($chats); $i++) {
		$name = $chats[$i];
		if(is_dir("./chatlog/$name")){
			if($name != "." && $name != "..") {
				echo "<div class=\"v21_2\" id=\"chat$i\" onclick=\"servSet('$name');\">$name</div>";

			}
		}
	}

	echo "<div id=\"addsv\" onclick=\"$('#serva').modal('show');\" class=\"v21_2\">Add Server</div>";

	//echo "</ul>";
?>