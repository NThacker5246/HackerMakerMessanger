<?php

require_once '../db/db.php';

$login = $_POST["login"];
$pwd = $_POST["password"];

table_insert($login, $pwd);

header("Location: ../login/index.php");

?>