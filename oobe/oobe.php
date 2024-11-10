<?php
	
	define('WAY', '../db/table.json');

	require_once '../db/db.php';
	try {
		$file = $_FILES["file"];
		$file_name = $file['name'];
		$file_tmp = $file['tmp_name'];
		$file_size = $file['size'];
		$file_error = $file['error'];

		$pass = $_POST['pass'];
		$sd = $_POST['sd'];
		$ht = $_POST['ht'];
		$us = $_POST['us'];
		$im = $_POST['im'];

		$real_flag = 0;
		
		if(isset($sd)){
			$real_flag += 1;
		}

		if(isset($ht)){
			$real_flag += 2;
		}
		
		if(isset($us)){
			$real_flag += 4;
		}
		
		if(isset($im)){
			$real_flag += 8;
		}

		if($file_error == 0){
			$destination = '../img/' . $file_name;
			move_uploaded_file($file_tmp, $destination);
			table_update($_SESSION['login'], $pass, "./img/$file_name", $real_flag);
			echo "File sent, password update";
			echo "Relocating";
			header("Location: ../index.php");
		} else {
			$pf = table_get($_SESSION['login']);
			table_update($_SESSION['login'], $pass, $pf->image, $real_flag);
			echo "Password update";
			echo "Relocating";
			header("Location: ../index.php");
		}

	} catch (Exception $e) {

		$pf = table_get($_SESSION['login']);

		$pass = $_POST['pass'];

		$sd = $_POST['sd'];
		$ht = $_POST['ht'];
		$us = $_POST['us'];
		$im = $_POST['im'];
		$real_flag = 0;
		
		if(isset($sd)){
			$real_flag += 1;
		}

		if(isset($ht)){
			$real_flag += 2;
		}
		
		if(isset($us)){
			$real_flag += 4;
		}
		
		if(isset($im)){
			$real_flag += 8;
		}

		
			
		table_update($_SESSION['login'], $pass, $pf->image, $real_flag);
		echo "Password update";
		echo "Relocating";
		header("Location: ../index.php");
		
	}
?>