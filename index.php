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
	<div class="cont">
		<div class="col-md-3 bar"></div>
		<div class="col-md-8 bar">
			<div class="output">
				<div id="otvet"></div>
			</div>

			<form method="GET" name="address" class="input">
				<input type="text" name="message" class="input-field" id="inpText">
				<button type="submit" class="btn btn-primary">Send!</button>	
			</form>

			<form method="POST" name="fileF">
				<input type="file" name="file">
				<button type="submit" id="filesent">Send!</button>	
			</form>
		</div>
		<div class="col-md-1 bar profile-bar">
			<div>
				<img src="/img/50x50.png">
			</div>
			<p>
				<?=$_SESSION['login']?>
			</p>
		</div>
	</div>

	<div id="action" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Заголовок</h5>
					<button type="button" class="close" data-dismiss="modal" id="cls2">
						&times;
					</button>
				</div>
				<div class="modal-body">
					<p>Что вы хотите сделать</p>
				
					<select name="act" id="act">
						<option value="del">Удалить сообщение</option>
						<option value="edi">Измеинть сообщение</option>
					</select>
					<br>
					<button type="button" class="btn btn-info" id="actB">Применить</button>
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning"  data-dismiss="modal" id="cls3">
						Закрыть
					</button>
				</div>
			</div>
		</div>
	</div>

	<a href="./login/logout.php" class="btn btn-danger">Log Off</a>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script type="text/javascript" src="lib.js"></script>
	<script type="text/javascript" src="send.js"></script>
	<script type="text/javascript" src="file.js"></script>
</body>
</html>