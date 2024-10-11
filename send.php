<?php
	require_once './db/db.php';

	$text = $_GET["text"];

	if(!empty($text)){
		$data = file_get_contents("./chatlog/test.txt");
		$data .= "<br>";
		$data .= $_SESSION['login'] . ">";
		$arr = explode("```", $text);
		for ($i=0; $i < count($arr); $i++) { 
			if($i & (2 - 1) > 0){
				$enc = htmlentities($arr[$i]);
				$has = hash("sha256", $enc);
				$has = trim($has);
				$data .= "<div><textarea id=\"$has\" readonly>$enc</textarea><br><button type=\"button\" onclick=\"copy('$has');\" >Copy</button></div>";
			} else {
				$data .= $arr[$i];
			}
		}
		$file = fopen("./chatlog/test.txt", "w");
		$f = fwrite($file, $data);
		$f2 = fclose($file);
		echo $data;
	} else {
		$data = file_get_contents("./chatlog/test.txt");
		echo $data;
	}
	

?>