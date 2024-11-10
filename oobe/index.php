<?php
	define('WAY', '../db/table.json');
	require_once '../db/db.php';
	$pf = table_get($_SESSION['login']);
	define('NAME', $pf->name);
	define('PASS', $pf->password);
	define('ID', $pf->id);
	define('IMG', "../$pf->img");
	define('FLAGS', $pf->flags);
	define('ISP', $pf->donate);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Подготовка к первому использоованию</title>
	<link rel="stylesheet" type="text/css" href="../style/oobe.css">
</head>
<body>
	<div class="cont-oobe">
		<div class="profile-oobe">
			<form name="upPF" id="upPF" action="oobe.php" enctype="multipart/form-data" method="POST">
				<div class="name">
					<?=NAME?>
				</div>
				<div class="id">
					<?=ID?>
				</div>
				<input type="text" name="pass" class="password" value="<?=PASS?>">
				<br>
				<img src="<?=IMG?>" class="image">
				<br>
				<label>
					<input type="file" name="file">
				</label><br>
				<button type="submit">Update</button>
				<hr>
				<div>
					<p>Премиум опции</p>
					Безопасное скачивание<div class="outer-box checkbox">
                        <div class="inner-box"></div>
                       	<input type="checkbox" name="sd" class="cb">
                    </div><br>
                    Скрытие выбора типа файлов (автовыбор)<div class="outer-box checkbox">
                        <div class="inner-box"></div>
                       	<input type="checkbox" name="ht" class="cb">
                    </div><br>
                    Расширение размера загружаемого файла<div class="outer-box checkbox">
                        <div class="inner-box"></div>
                       	<input type="checkbox" name="us" class="cb">
                    </div><br>
				    Режим неведимки<div class="outer-box checkbox">
                        <div class="inner-box"></div>
                       	<input type="checkbox" name="im" class="cb">
                    </div><br>
				</div>
			</form>
		</div>
	</div>
	<!--
		<script type="text/javascript" src="oobe.js"></script>
	-->
	<script type="text/javascript">
		const FLAGS = <?=FLAGS?>;
	</script>
    <script type="text/javascript" src="../checkbox.js"></script>
</body>
</html>