<?php
	session_start();
	try {

		$serv = $_POST["server"];
		$chat = $_POST["chat"];

		$type = $_POST["typeMedia"];

		$file = $_FILES["file"];
		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];
		if($file_error == 0){
			$destination = './files/' . $file_name;
			move_uploaded_file($file_tmp, $destination);
			$data = file_get_contents("./chatlog/$serv/$chat");
			$data .= "<br>";
			$arr = explode("```", $text);
			$msg = explode("<br>", $data);
			$num = count($msg);
			$nick = $_SESSION['login'];
			switch ($type) {
				case 'file':
					$data .="<div id=\"m$num\" class=\"font\" onclick=\"call_act_file('m$num');\">$nick><a href=\"$destination\" download=\"\">$file_name</a></div>";
					break;
				
				case 'img':
					$data .="<div id=\"m$num\" class=\"font\" onclick=\"call_act_file('m$num');\">$nick><img src=\"$destination\"></div>";
					break;

				case 'video':			
					$data .="<div id=\"m$num\" class=\"font\" onclick=\"call_act_file('m$num');\">$nick><video src=\"$destination\" controls=\"\"></video></div>";
					break;
				case 'audio':			
					$data .="<div id=\"m$num\" class=\"font\" onclick=\"call_act_file('m$num');\">$nick><audio src=\"$destination\" controls=\"\"></audio></div>";
					break;

				default:
					$data .="<div id=\"m$num\" class=\"font\" onclick=\"call_act_file('m$num');\">$nick><a href=\"$destination\" download=\"\">$file_name</a></div>";
					break;
			}
			
			$file = fopen("./chatlog/$serv/$chat", "w");
			$f = fwrite($file, $data);
			$f2 = fclose($file);
			echo $data;
			echo "Mistake";
			
		}
	} catch (Exception $e){
		$data = file_get_contents("./chatlog/test.txt");
		$data .= "<br>";
		$data .= "$e";
		$file = fopen("./chatlog/$serv/$chat", "w");
		$f = fwrite($file, $data);
		$f2 = fclose($file);
		echo ($e);
	}

?>