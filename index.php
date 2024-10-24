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
		<div class="col-md-1">
			<div id="servID">
			</div>
			<button id="addsv" type="button">Add Server</button>
		</div>
		<div class="col-md-2 bar">
			<div id="chatsID">
			</div>
			<button id="addch" type="button">Add Chat</button>
		</div>
		<div class="col-md-8 bar">
			<div class="output">
				<div id="otvet"></div>
			</div>

			<form method="GET" name="address" class="input">
				<input type="text" name="message" class="input-field" autocomplete="off" id="inpText">
				<button type="submit" class="btn btn-primary btn-send">Send!</button>	
			</form>

			<form method="POST" name="fileF">
				<input type="file" name="file">
				<input type="hidden" name="server" id="serv1">
				<input type="hidden" name="chat" id="chat1">
				<select name="typeMedia" id="typeMedia">
					<option value="file">File</option>
					<option value="img">Image</option>
					<option value="video">Video</option>
					<option value="audio">Audio</option>
				</select>
				<button type="submit" id="filesent">Send!</button>	
			</form>
		</div>
		<div class="col-md-1 bar profile-bar">
			<div class="row">
				<img src="/img/50x50.png" class="profile-image">
			</div>
			<div class="row">
				<p class="text-center font">
					<?=$_SESSION['login']?>
				</p>
			</div>
			<div class="row">
				<p class="text-center">
					<a href="./login/logout.php" class="btn btn-danger">Log Off</a>
				</p>
			</div>
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

	<div id="action_file" class="modal fade" tabindex="-1">
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
					</select>
					<br>
					<button type="button" class="btn btn-info" id="actD">Применить</button>
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning"  data-dismiss="modal" id="cls3">
						Закрыть
					</button>
				</div>
			</div>
		</div>
	</div>

	<div id="chat" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Создание чата</h5>
					<button type="button" class="close" data-dismiss="modal" id="cls2">
						&times;
					</button>
				</div>
				<div class="modal-body">
					<p>Название чата</p> <input type="text" id="chatName" name="chatName">
					<br>
					<button type="button" class="btn btn-info" id="chAdd">Применить</button>
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning"  data-dismiss="modal" id="cls3">
						Закрыть
					</button>
				</div>
			</div>
		</div>
	</div>

	<div id="serva" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Создание чата</h5>
					<button type="button" class="close" data-dismiss="modal" id="cls2">
						&times;
					</button>
				</div>
				<div class="modal-body">
					<p>Название сервера</p> <input type="text" id="svName" name="chatName">
					<br>
					<button type="button" class="btn btn-info" id="svAdd">Применить</button>
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning"  data-dismiss="modal" id="cls3">
						Закрыть
					</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script type="text/javascript" src="lib.js"></script>
	<script type="text/javascript" src="send.js"></script>
	<script type="text/javascript" src="file.js"></script>
	<script type="text/javascript" src="chatadd.js"></script>
</body>
</html>