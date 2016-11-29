<?php

class Montage {
	protected $id;
	protected $user_id;
	protected $created_at;
	protected $src;

	function User($id, $user_id, $created_at, $src) {
		$this->id = $id;
		$this->user_id = $user_id;
		$this->created_at = $created_at;
		$this->src = $src;
	}

	function get_id() {
		return $this->id;
	}

	function get_user_id() {
		return $this->user_id;
	}

	function get_created_at() {
		return $this->created_at;
	}

	function get_src() {
		return $this->src;
	}

	static function create($user_id, $src) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		$created_at = date("Y-m-d H:i:s");
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('INSERT INTO Montage
				VALUES (NULL, :user_id, :created_at, :src)');
			$sql->bindValue(':user_id', $user_id, PDO::PARAM_INT);
			$sql->bindValue(':created_at', $created_at, PDO::PARAM_STR);
			$sql->bindValue(':src', $src, PDO::PARAM_STR);
			$sql->execute();

			$sql = $conn->prepare('SELECT *
				FROM Montage
				WHERE src = :src');
			$sql->bindValue(':src', $src, PDO::PARAM_STR);
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_NUM);
			$montage = new Montage($row[0], $row[1], $row[2], $row[3]);
			return $montage;
		} catch(PDOException $e) {
			echo '<p> Error in Montage::create() : '.$e->getMessage().'<p>';
			return false;
		}
	}

	static function get_all(){
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->query('SELECT * FROM `montage` ORDER BY created_at DESC ');
			$montages = $sql->fetchAll();
			return $montages;
		} catch(PDOException $e) {
			echo '<p> Error in Montage::get_All() : '.$e->getMessage().'<p>';
			return false;
		}
	}

}

?>
