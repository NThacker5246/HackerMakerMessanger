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
	public $img;
	public $flags;
	public $donate;

	public function __construct($l, $r, $id, $name, $password)
	{
		$this->l = $l;
		$this->r = $r;
		$this->id = $id;
		$this->name = $name;
		$this->password = $password;
		$this->img = "img/50x50.png";
		$this->flags = 0;
		$this->donate = false;
	}
}

class Handler
{
	public $tree;
}

class StackNode {
	public $prevNode;
	public $value;

	public function __construct($value, $prevNode){
		$this->value = $value;
		$this->prevNode = $prevNode;
	}
}

class Stack {
	public $lastNode;

	public function __construct($value)
	{
		$this->lastNode = new StackNode($value, null);
	}

	public function push($value)
	{
		$node = new StackNode($value, $this->lastNode);
		$this->lastNode = $node;
	}

	public function get()
	{
		return $this->lastNode->value;
	}

	public function pop()
	{
		$removing = $this->lastNode;
		$this->lastNode = $removing->prevNode;
	}

	public function not_empty()
	{
		if($this->lastNode == null){
			return false;
		} else {
			return true;
		}
	}
}

function HackerHash($value)
{
	$nick = str_split($value);
	$hash = 0;

	for ($i=0; $i < count($nick); $i++) { 
		$hash += ord($nick[$i]);
		$hash = ($hash << 5) - $hash;
	}

	return $hash;
}

function table_insert($name, $password)
{
	$text = file_get_contents(WAY);
	$obj = json_decode($text);
	if(empty($obj)){
		$obj = new Handler();
		$obj->tree = new Tree(null, null, HackerHash($name), $name, $password);
		$data = json_encode($obj);
		$file = fopen(WAY, "w");
		$f = fwrite($file, $data);
		$end = fclose($file);
		var_dump($data);
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
						$file = fopen(WAY, "w");
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
						$file = fopen(WAY, "w");
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
	$text = file_get_contents(WAY);
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

function table_update($name, $pass, $img, $flags)
{
	$text = file_get_contents(WAY);
	$obj = json_decode($text);

	$id = HackerHash($name);
	$temp = $obj->tree; 
	while (1) {
		if($temp == null){
			return;
		}

		if ($temp->id == $id) {
			$temp->password = $pass;
			$temp->img = $img;
			$temp->flags = $flags;

			$data = json_encode($obj);
			$file = fopen(WAY, "w");
			$f = fwrite($file, $data);
			$end = fclose($file);


			return;
		} else {
			if($id > $temp->id){
				$temp = $temp->l;
			} else {
				$temp = $temp->r;
			}
		}
	}
}

function table_simetrical()
{	
	$text = file_get_contents(WAY);
	$obj = json_decode($text);

	$stack = new Stack($obj->tree);
	$hash_table = [];
	$counter = 0;

	while ($stack->not_empty()) {
		//echo $stack->lastNode->value->name;
		//echo "<br>";
		//var_dump($hash_table);
		echo "<br>";
		$cur_node = $stack->get();

		if ($cur_node->l != null && empty($hash_table[$cur_node->l->name])) {
			$stack->push($cur_node->l);
			continue;
		}

		if(empty($hash_table[$cur_node->name]) && $cur_node->img != null){
			$hash_table[$cur_node->name] = "<img class=\"v22_18 pb\" src=\"$cur_node->img\" value=\"$cur_node->name\"";
			$counter += 1;
		}

		if($cur_node->r != null && empty($hash_table[$cur_node->r->name])){
			$stack->push($cur_node->r);
			continue;
		}

		$stack->pop();
	}

	echo "<div style=\"width: " . $counter*70 . "px;\">";
	foreach ($hash_table as $key => $value) {
		echo "$value<br>";
	}
	echo "</div>";

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