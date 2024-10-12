<?php
	session_start();

	//-----Checking Login-----
	if(!isset($_SESSION['login'])){
		//Relocating
		header("Location: /login/");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>HackerMakerMessenger</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/style/style.css">
</head>
<body>
	<div class="output">
		<div id="otvet"></div>
	</div>

	<form method="GET" name="address" class="input">
		<input type="text" name="message" class="input-field" id="inpText">
		<button type="submit" class="btn btn-primary" style="width: 4%;">Send!</button>	
	</form>

	<form method="POST" name="fileF">
		<input type="file" name="file">
		<button type="submit" id="filesent">Send!</button>	
	</form>

	<a href="./login/logout.php" class="btn btn-danger">Log Off</a>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script type="text/javascript" src="lib.js"></script>
	<script type="text/javascript" src="send.js"></script>
	<script type="text/javascript" src="file.js"></script>
</body>
</html>