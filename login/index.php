<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Log In to HackerMakerMessage</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="">
			<div class="">
				<form method="POST" action="log.php">
					<input type="text" name="login" placeholder="login"><br>
					<input type="password" name="password" placeholder="Password">
					<hr>
					<button type="submit" class="btn btn-secondary">Login</button>
				</form>
			</div>
		</div>
		<a href="../register">Нет аккаунта? Зарегайся!</a>
	</div>
</body>
</html>