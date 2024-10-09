<!DOCTYPE html>
<html style="width: 100%; height: 100%; margin: 0px;">
<head>
	<title>HackerMakerMessenger</title>
</head>
<body style="width: 100%; height: 100%; margin: 0px;">
	<div style="width: 100%; height: 90%;">
		<div id="otvet" style="overflow-y:scroll; width: 100%; height: 100%;"></div>
	</div>

	<form method="GET" name="address">
		<input type="text" name="message"><br>
		<button type="submit">Send!</button>	
	</form>

	<form method="POST" name="fileF">
		<input type="file" name="file"><br>
		<button type="submit" id="filesent">Send!</button>	
	</form>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="send.js"></script>
	<script type="text/javascript" src="file.js"></script>
</body>
</html>