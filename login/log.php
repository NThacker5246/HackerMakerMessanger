<?php

define('WAY', '../db/table.json');

require_once '../db/db.php';

$login = $_POST["login"];
$pwd = $_POST["password"];

if(table_get($login)->password == $pwd){
	header("Location: ../index.php");
	$_SESSION["login"] = $login;
}