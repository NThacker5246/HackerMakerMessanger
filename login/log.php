<?php

require_once '../db/db.php';

$login = $_POST["login"];
$pwd = $_POST["password"];

if(table_get($login)[1] == $pwd){
	header("Location: ../index.php");
	$_SESSION["login"] = $login;
}