<?php

class Comment {
	protected $id;
	protected $montage_id;
	protected $created_at;
	protected $content;

	function Comment($id, $montage_id, $created_at, $content) {
		$this->id = $id;
		$this->montage_id = $montage_id;
		$this->created_at = $created_at;
		$this->content = $content;
	}

	function get_id() {
		return $this->id;
	}

	function get_montage_id() {
		return $this->montage_id;
	}

	function get_created_at() {
		return $this->created_at;
	}

	function get_content() {
		return $this->content;
	}

	static function post($montage_id, $content) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		$created_at = date("Y-m-d H:i:s");
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('INSERT INTO Comment
				VALUES (NULL, :montage_id, :created_at, :content)');
			$sql->bindValue(':montage_id', $montage_id, PDO::PARAM_INT);
			$sql->bindValue(':created_at', $created_at, PDO::PARAM_STR);
			$sql->bindValue(':content', $content, PDO::PARAM_STR);
			$sql->execute();
      $conn = NULL;
			return true;
		} catch(PDOException $e) {
			echo '<p> Error in Comment::post() : '.$e->getMessage().'<p>';
			return false;
		}
	}

	static function get_comments_by_montage($montage_id) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('SELECT *
				FROM Comment
        WHERE montage_id = :montage_id
        ORDER BY created_at DESC');
      $sql->bindValue(':montage_id', $montage_id, PDO::PARAM_INT);
			$sql->execute();
      $comments = array();
			while (($row = $sql->fetch(PDO::FETCH_NUM))) {
				$comments[] = new Comment($row[0], $row[1], $row[2], $row[3]);
			}
			$conn = NULL;
			return $comments;
		} catch(PDOException $e) {
			echo '<p> Error in Comment::get_comments_by_montage() : '
        .$e->getMessage().'<p>';
			return false;
		}
	}

}

?>
