<?php
define('WAY', 'db/table.json');

require_once 'db/db.php';

$name = $_GET['name'];
$data = table_get($name);

echo "
<img class=\"card-img-top\" src=\"$data->img\">
<div class=\"card-body\">
	<h5 class=\"card-title\">$name</h5>
	<p>$data->id</p>
</div>
";

?>