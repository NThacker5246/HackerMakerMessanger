<?php
	require_once './db/db.php';

	$text = $_GET["text"];
	if(!empty($text)){
		$data = file_get_contents("./chatlog/test.txt");
		$data .= "<br>";
		$data .= $_SESSION['login'] . ">";
		$data .= $text;
		$file = fopen("./chatlog/test.txt", "w");
		$f = fwrite($file, $data);
		$f2 = fclose($file);
		echo $data;
	} else {
		$data = file_get_contents("./chatlog/test.txt");
		echo $data;
	}
	

?>