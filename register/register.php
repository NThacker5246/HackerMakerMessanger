<?php

define('WAY', '../db/table.json');

require_once '../db/db.php';

$login = $_POST["login"];
$pwd = $_POST["password"];

table_insert($login, $pwd);
$_SESSION["login"] = $login;

header("Location: ../oobe/index.php");

?>