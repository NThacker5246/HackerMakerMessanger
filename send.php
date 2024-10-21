<?php
	require_once './db/db.php';

	$text = $_GET["text"];
	$id = $_GET["num"];
	$chat = $_GET["chat"];
	$serv = $_GET["serv"];
	if(!empty($chat)) {
		if(!empty($text)){
			$data = file_get_contents("./chatlog/$serv/$chat");
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
			$file = fopen("./chatlog/$serv/$chat", "w");
			$f = fwrite($file, $data);
			$f2 = fclose($file);
			echo $data;
		} else {
			$data = file_get_contents("./chatlog/$serv/$chat");
			if(!empty($id)){
				$msg = explode("<br>", $data);
				$file_check = explode("download=\"\"", $msg[intval($id - 1)]);
				echo($file_check[0]);			
				if(!empty($file_check[1])){
					$num = count($msg);
					$nick = $_SESSION['login'];
					$fl = trim($file_check[0], "<div id=\"m$num\" class=\"font\" onclick=\"call_act_file('m$num');\">$nick><a href=\"");
					$fl = trim($fl, "\"");
					unlink($fl . 'e');
				}
				$msg[intval($id - 1)] = '';
				$data = implode("<br>", $msg);
				$file = fopen("./chatlog/$serv/$chat", "w");
				$f = fwrite($file, $data);
				$f2 = fclose($file);
			}
			echo $data;
		}
	}	

?>