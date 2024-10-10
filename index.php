<?php
	if(empty($SESSION['login'])){
		header("Location: ./login/index.php");
	}
?>

<!DOCTYPE html>
<html style="width: 100%; height: 100%; margin: 0px;">
<head>
	<meta charset="utf-8">
	<title>HackerMakerMessenger</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="width: 100%; height: 100%; margin: 0px;">
	<div style="width: 100%; height: 90%;">
		<div id="otvet" style="overflow-y:scroll; width: 100%; height: 100%;"></div>
	</div>

	<form method="GET" name="address">
		<input type="text" name="message" style="width: 95%;">
		<button type="submit" class="btn btn-primary" style="width: 4%;">Send!</button>	
	</form>

	<form method="POST" name="fileF">
		<input type="file" name="file">
		<button type="submit" id="filesent">Send!</button>	
	</form>

	<a href="./login/logout.php" class="btn btn-danger">Log Off</a>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script type="text/javascript" src="send.js"></script>
	<script type="text/javascript" src="file.js"></script>
</body>
</html>