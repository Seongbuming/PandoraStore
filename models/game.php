<?php
class Game {
	private $mysqli = NULL;
	private $table = NULL;

	function __construct($link, $table) {
		$this->mysqli = $link;
		$this->table = $table;
	}

	function loadAll() {
		$data = array();
		if($result = $this->mysqli->query("SELECT * FROM $this->table ORDER BY CreatedTime DESC")) {
			for($i = 0; $i < $result->num_rows; $i++)
				$data[$i] = $result->fetch_assoc();
			$result->free();
		}
		return $data;
	}

	function load($id) {
		$id = (int)$id;
		if($result = $this->mysqli->query("SELECT * FROM $this->table WHERE ID = $id")) {
			$data = $result->fetch_assoc();
			$result->free();
			return $data;
		}
		return NULL;
	}
}
?>