<?php

	$name = $_GET['name'];

	$file = fopen("./chatlog/$name", "w");
	$f = fwrite($file, "<br>");
	$f2 = fclose($file);

?>