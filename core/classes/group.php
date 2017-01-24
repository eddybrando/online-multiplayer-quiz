<?php
class Group{
	private $db = '';
	public $name = '';

	public function __construct($db) {
		$this->db = $db;
	}

	/**
	 * Checks if the group name is valid.
	 *
	 * @return Boolean Whether the group name is valid or not.
	 */
	public function name_is_valid() {
		if($this->name === NULL ||
		   $this->name === false ||
		   $this->name === '') {
			return false;
		} else if($this->name_exists()){
			return false;
		} else {
			return true;
		}
	}

	public function get_name($id) {
		$sql = $this->db->prepare("SELECT `name`
			FROM `groups`
    	WHERE `id` = $id");
    $sql->execute();
		return $sql->fetchColumn();
	}

	/**
	 * Checks if the group name already exists in the database.
	 */
	private function name_exists() {
		$sql = $this->db->prepare("SELECT name FROM groups WHERE name=?");
		$sql->bindParam(1, $this->name, PDO::PARAM_STR);
    $sql->execute();
		$result = $sql->fetch(PDO::FETCH_ASSOC);

		if($result === false) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Creates a new group in the database.
	 */
	public function register() {
		$sql = "INSERT INTO groups (name)
    	VALUES ('$this->name')";
    $this->db->exec($sql);
		return $this->db->lastInsertId();
	}
}
