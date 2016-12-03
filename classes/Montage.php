<?php

class Montage {
	protected $id;
	protected $user_id;
	protected $created_at;
	protected $src;

	function Montage($id, $user_id, $created_at, $src) {
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

	static function get_nb_montage() {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('SELECT COUNT(*)
				FROM Montage');
			$sql->execute();
			$return = $sql->fetchColumn();
			$conn = NULL;
			return $return;
		} catch(PDOException $e) {
			echo '<p> Error in Montage::get_nb_montage() : '.$e->getMessage().'<p>';
			return 0;
		}
	}

	static function get_montage_paginated($limit, $offset) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('SELECT *
				FROM Montage
				ORDER BY created_at DESC
				LIMIT :limit
				OFFSET :offset
				');
			$sql->bindValue(':limit', $limit, PDO::PARAM_INT);
			$sql->bindValue(':offset', $offset, PDO::PARAM_INT);
			$sql->execute();
			$montages = array();
			while (($row = $sql->fetch(PDO::FETCH_NUM))) {
				$montages[] = new Montage($row[0], $row[1], $row[2], $row[3]);
			}
			$conn = NULL;
			return $montages;
		} catch(PDOException $e) {
			echo '<p> Error in Montage::get_montage_paginated : '
				.$e->getMessage().'<p>';
			return false;
		}
	}

	static function is_montage_exist($id) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('SELECT COUNT(*)
				FROM Montage
				WHERE id = :id');
			$sql->bindValue(':id', $id, PDO::PARAM_INT);
			$sql->execute();
			$return = false;
			if ($sql->fetchColumn() > 0)
				$return = true;
			$conn = NULL;
			return $return;
		} catch(PDOException $e) {
			echo '<p> Error in Montage::is_montage_exist() : '
				.$e->getMessage().'<p>';
			return false;
		}
	}

	static function del_montage($id) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('DELETE
				FROM Montage
				WHERE id = :id');
			$sql->bindValue(':id', $id, PDO::PARAM_INT);
			$sql->execute();
			$conn = NULL;
			return true;
		} catch(PDOException $e) {
			echo '<p> Error in Montage::del_montage() : '
				.$e->getMessage().'<p>';
			return false;
		}
	}

}

?>
