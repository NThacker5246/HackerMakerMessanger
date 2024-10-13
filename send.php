<?php
	require_once './db/db.php';

	$text = $_GET["text"];
	$id = $_GET["num"];

	if(!empty($text)){
		$data = file_get_contents("./chatlog/test.txt");
		if(!empty($id)){

			$newMsg = "";
			$arr = explode("```", $text);
			$msg = explode("<br>", $data);
			$num = count($msg);
			$newMsg .= "<div id=\"m$num\" class=\"font\" onclick=\"call_act('m$num');\">";
			$newMsg .= $_SESSION['login'] . ">";
			for ($i=0; $i < count($arr); $i++) { 
				if($i & (2 - 1) > 0){
					$enc = htmlentities($arr[$i]);
					$has = hash("sha256", $enc);
					$has = trim($has);
					$newMsg .= "<div><textarea id=\"$has\" readonly>$enc</textarea><br><button type=\"button\" onclick=\"copy('$has');\" >Copy</button></div>";
				} else {
					$newMsg .= $arr[$i];
				}
			}
			$data .= "</div>";

			$msg = explode("<br>", $data);			
			$msg[intval($id - 1)] = $newMsg;
			$data = implode("<br>", $msg);
		} else {
			$data .= "<br>";
			$arr = explode("```", $text);
			$msg = explode("<br>", $data);
			$num = count($msg);
			$data .= "<div id=\"m$num\" class=\"font\" onclick=\"call_act('m$num');\">";
			$data .= $_SESSION['login'] . ">";
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
			$data .= "</div>";
		}
		$file = fopen("./chatlog/test.txt", "w");
		$f = fwrite($file, $data);
		$f2 = fclose($file);
		echo $data;
	} else {
		$data = file_get_contents("./chatlog/test.txt");
		if(!empty($id)){
			$msg = explode("<br>", $data);			
			$msg[intval($id - 1)] = '';
			$data = implode("<br>", $msg);
			$file = fopen("./chatlog/test.txt", "w");
			$f = fwrite($file, $data);
			$f2 = fclose($file);
		}
		echo $data;
	}
	

?>