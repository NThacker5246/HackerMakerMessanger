<?php

session_start();

class Table {
	public $users = [];
}

function table_insert($params=[])
{
	$text = file_get_contents("../db/table.json");
	$obj = json_decode($text);
	var_dump($obj);
	if(empty($obj)){
		$obj = new Table();
		$obj->users = array($params);
		$data = json_encode($obj);
		$file = fopen("table.json", "w");
		$f = fwrite($file, $data);
		$end = fclose($file);
	} else {
		array_push($obj->users, $params);
		$data = json_encode($obj);
		$file = fopen("table.json", "w");
		$f = fwrite($file, $data);
		$end = fclose($file);
	}
}

function table_get($name)
{
	$text = file_get_contents("../db/table.json");
	$obj = json_decode($text);
	for ($i=0; $i < count($obj->users); $i++) { 
		if($name == $obj->users[$i][0]){
			return $obj->users[$i];
		}
	}
}

?>