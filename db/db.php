<?php

session_start();

class Table {
	public $users = [];
}

class Tree {
	public $l;
	public $r;
	public $id;
	public $name;
	public $password;

	public function __construct($l, $r, $id, $name, $password)
	{
		$this->l = $l;
		$this->r = $r;
		$this->id = $id;
		$this->name = $name;
		$this->password = $password;
		
	}
}

class Handler
{
	public $tree;
}

function HackerHash($value)
{
	$nick = str_split($value);
	$hash = 0;

	for ($i=0; $i < count($nick); $i++) { 
		$hash = $hash << 5;
		$hash += ord($nick[$i]);
	}

	return $hash;
}

function table_insert($name, $password)
{
	$text = file_get_contents("../db/table.json");
	$obj = json_decode($text);
	if(empty($obj)){
		$obj = new Handler();
		$obj->tree = new Tree(null, null, HackerHash($name), $name, $password);
		$data = json_encode($obj);
		$file = fopen("table.json", "w");
		$f = fwrite($file, $data);
		$end = fclose($file);
	} else {
		$temp = $obj->tree;
		$id = HackerHash($name);
		while (1) {
			if($temp == null){
				return;
			}

			if ($temp->id == $id) {
				return $temp;
			} else {
				if($id > $temp->id){
					if($temp->l != null){
						$temp = $temp->l;
					} else {
						$temp->l = new Tree(null, null, $id, $name, $password);
						$data = json_encode($obj);
						$file = fopen("table.json", "w");
						$f = fwrite($file, $data);
						$end = fclose($file);
						return;				
					}
				} else {
					if($temp->r != null){
						$temp = $temp->r;
					} else {
						$temp->r = new Tree(null, null, $id, $name, $password);
						$data = json_encode($obj);
						$file = fopen("table.json", "w");
						$f = fwrite($file, $data);
						$end = fclose($file);
						return;				
					}
				}
			}
		}	
	}
}

/*
	array_push($obj->users, $params);
	$data = json_encode($obj);
	$file = fopen("table.json", "w");
	$f = fwrite($file, $data);
	$end = fclose($file);
*/

function table_get($name)
{
	$text = file_get_contents("../db/table.json");
	$obj = json_decode($text);

	$id = HackerHash($name);
	$temp = $obj->tree; 
	while (1) {
		if($temp == null){
			return;
		}

		if ($temp->id == $id) {
			return $temp;
		} else {
			if($id > $temp->id){
				$temp = $temp->l;
			} else {
				$temp = $temp->r;
			}
		}
	}
}

/*
	for ($i=0; $i < count($obj->users); $i++) { 
		if($name == $obj->users[$i][0]){
			return $obj->users[$i];
		}
	}
*/

/*
table_insert("NThacker", "1234");
table_insert("GiMaker", "1234");
table_insert("ARS3NY", "1234");

var_dump(table_get("ARS3NY")->name);
*/
?>