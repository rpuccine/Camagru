<?php

class User {
	protected $id;
	protected $user_name;
	protected $password;
	protected $mail;

	function User($id, $user_name, $password, $mail) {
		$this->id = $id;
		$this->user_name = $user_name;
		$this->password = $password;
		$this->mail = $mail;
	}

	function get_id() {
		return $this->id;
	}

	function get_user_name() {
		return $this->user_name;
	}

	function get_password() {
		return $this->password;
	}

	function get_mail() {
		return $this->mail;
	}

	function set_user_name($user_name) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('UPDATE User
				SET user_name = :user_name
				WHERE id = :id');
			$sql->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$sql->bindValue(':id', $this->id, PDO::PARAM_INT);
			$sql->execute();
			$conn = NULL;
			$this->user_name = $user_name;
			return true;
		} catch(PDOException $e) {
			echo '<p> Error in User->set_user_name() : '.$e->getMessage().'<p>';
			return false;
		}
	}

	function set_mail($mail) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('UPDATE User
				SET mail = :mail
				WHERE id = :id');
			$sql->bindValue(':mail', $mail, PDO::PARAM_STR);
			$sql->bindValue(':id', $this->id, PDO::PARAM_INT);
			$sql->execute();
			$conn = NULL;
			$this->mail = $mail;
			return true;
		} catch(PDOException $e) {
			echo '<p> Error in User->set_mail() : '.$e->getMessage().'<p>';
			return false;
		}
	}

	function set_password($pwd) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		$pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('UPDATE User
				SET password = :pwd
				WHERE id = :id');
			$sql->bindValue(':pwd', $pwd_hash, PDO::PARAM_STR);
			$sql->bindValue(':id', $this->id, PDO::PARAM_INT);
			$sql->execute();
			$conn = NULL;
			$this->password = $pwd_hash;
			return true;
		} catch(PDOException $e) {
			echo '<p> Error in User->set_password() : '.$e->getMessage().'<p>';
			return false;
		}
	}

	static function create($user_name, $pwd, $mail) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		$pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('INSERT INTO User
				VALUES (NULL, :user_name, :pwd, :mail)');
			$sql->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$sql->bindValue(':pwd', $pwd_hash, PDO::PARAM_STR);
			$sql->bindValue(':mail', $mail, PDO::PARAM_STR);
			$sql->execute();
			$conn = NULL;
			return true;
		} catch(PDOException $e) {
			echo '<p> Error in User::create() : '.$e->getMessage().'<p>';
			return false;
		}
	}

	static function is_user_name_exist($user_name) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('SELECT COUNT(*)
				FROM User
				WHERE user_name = :user_name');
			$sql->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$sql->execute();
			$return = false;
			if ($sql->fetchColumn() > 0)
				$return = true;
			$conn = NULL;
			return $return;
		} catch(PDOException $e) {
			echo '<p> Error in User::is_user_name_exist() :</p>'.
			'<p>Msg : '.$e->getMessage().'</p>'.
			'<p>File : '.$e->getFile().'</p>'.
			'<p>Line : '.$e->getLine().'</p>'.
			'<p>Trace : '.$e->getTraceAsString().'</p>';
			return true;
		}
	}

	static function sign_in($user_name, $pwd) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		$return = array(
			"result" => false,
			"data" => ''
		);
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);

			// Verif User_name
			$sql = $conn->prepare('SELECT COUNT(*)
				FROM User
				WHERE user_name = :user_name');
			$sql->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$sql->execute();
			if ($sql->fetchColumn() != 1) {
				$return['data'] = 'Wrong User_name';
				$conn = NULL;
				return $return;
			}

			// Verif Password
			$sql = $conn->prepare('SELECT *
				FROM User
				WHERE user_name = :user_name');
			$sql->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_NUM);
			if (!password_verify($pwd, $row[2])) {
				$return['data'] = 'Wrong password';
				$conn = NULL;
				return $return;
			}

			// Construct User and return it
			$return['result'] = true;
			$return['data'] = new User($row[0], $row[1], $row[2], $row[3]);
			$conn = NULL;
			return $return;
		} catch(PDOException $e) {
			echo '<p> Error in User::sign_in() :</p>'.
			'<p>Msg : '.$e->getMessage().'</p>'.
			'<p>File : '.$e->getFile().'</p>'.
			'<p>Line : '.$e->getLine().'</p>'.
			'<p>Trace : '.$e->getTraceAsString().'</p>';
			return $return;
		}
	}
}

?>
