<?php

	$name = $_GET['name'];
	$serv = $_GET['serv'];

	$file = fopen("./chatlog/$serv/$name", "w");
	$f = fwrite($file, "<br>");
	$f2 = fclose($file);

?>