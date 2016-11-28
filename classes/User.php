<?php

class User {
	protected $id;
	protected $user_name;
	protected $password;
	protected $mail;
	protected $key_val;
	protected $is_active;

	function User($id, $user_name, $password, $mail, $key_val, $is_active) {
		$this->id = $id;
		$this->user_name = $user_name;
		$this->password = $password;
		$this->mail = $mail;
		$this->key_val = $key_val;
		$this->is_active = $is_active;
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

	function get_key_val() {
		return $this->key_val;
	}

	function get_is_active() {
		return $this->is_active;
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

	function set_is_active($bool) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('UPDATE User
				SET is_active = :bool
				WHERE id = :id');
			$sql->bindValue(':bool', $bool, PDO::PARAM_INT);
			$sql->bindValue(':id', $this->id, PDO::PARAM_INT);
			$sql->execute();
			$conn = NULL;
			$this->is_active = $bool;
			return true;
		} catch(PDOException $e) {
			echo '<p> Error in User->set_is_active() : '.$e->getMessage().'<p>';
			return false;
		}
	}

	function send_verif_mail() {
		$dst = $this->mail;
		$subject = 'Validation de votre compte Camagru';

		$key = array('user_name' => $this->user_name, 'key_val' => $this->key_val);
		$url = http_build_query($key);
		$msg = "Bonjour ".$this->user_name.",\r\n\r\n".
			"Suivez ce Lien pour activer votre compte Camagru :\r\n".
			'http://localhost:8080/pages/account_validation.php?'.$url;

		$headers = 'From: rpuccine@student.42.fr';

		if (mail($dst, $subject, $msg, $headers)) {
			return true;
		}
		return false;
	}

	function send_reset_pwd_mail() {
		$dst = $this->mail;
		$subject = 'Mot de passe oublié Camagru';

		$key = array('user_name' => $this->user_name, 'key_val' => $this->key_val);
		$url = http_build_query($key);
		$msg = "Bonjour ".$this->user_name.",\r\n\r\n".
			"Suivez ce Lien pour reinitialiser le mot de passe votre compte Camagru :\r\n".
			'http://localhost:8080/pages/reset_pwd.php?'.$url;

		$headers = 'From: rpuccine@student.42.fr';

		if (mail($dst, $subject, $msg, $headers)) {
			return true;
		}
		return false;
	}

	static function get_user($user_name) {
		if (!self::is_user_name_exist($user_name)) {
			return false;
		}
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('SELECT *
					FROM User
					WHERE user_name = :user_name');
			$sql->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_NUM);
			$user = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
			return $user;
		} catch(PDOException $e) {
			echo '<p> Error in User::get_user() : '.$e->getMessage().'<p>';
			return false;
		}
	}

	static function create($user_name, $pwd, $mail) {
		include ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
		$pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
		$key_val = password_hash($user_name, PASSWORD_DEFAULT);
		try {
			$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
			$sql = $conn->prepare('INSERT INTO User
				VALUES (NULL, :user_name, :pwd, :mail, :key_val, 0)');
			$sql->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$sql->bindValue(':pwd', $pwd_hash, PDO::PARAM_STR);
			$sql->bindValue(':mail', $mail, PDO::PARAM_STR);
			$sql->bindValue(':key_val', $key_val, PDO::PARAM_STR);
			$sql->execute();

			$sql = $conn->prepare('SELECT *
				FROM User
				WHERE user_name = :user_name');
			$sql->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_NUM);
			$user = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
			return $user;
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
				$return['data'] = '<p>Wrong User_name.</p>';
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
				$return['data'] = '<p>Wrong password.</p>';
				$conn = NULL;
				return $return;
			}
			// Verif Compte Actif
			else if (!$row[5]) {
				$return['data'] = '<p>Compte inactif, Mail non verifie.</p>';
				$conn = NULL;
				return $return;
			}

			// Construct User and return it
			$return['result'] = true;
			$return['data'] = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
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

	static function validate_account($user_name, $key_val) {
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

			// Verif Key_val
			$sql = $conn->prepare('SELECT *
				FROM User
				WHERE user_name = :user_name');
			$sql->bindValue(':user_name', $user_name, PDO::PARAM_STR);
			$sql->execute();
			$row = $sql->fetch(PDO::FETCH_NUM);
			if ($key_val != $row[4]) {
				$return['data'] = 'Wrong key_val';
				$conn = NULL;
				return $return;
			}

			// Create User and return it
			$return['result'] = true;
			$return['data'] = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
			$conn = NULL;
			return $return;
		} catch(PDOException $e) {
			echo '<p> Error in User::validate_account() :</p>'.
			'<p>Msg : '.$e->getMessage().'</p>'.
			'<p>File : '.$e->getFile().'</p>'.
			'<p>Line : '.$e->getLine().'</p>'.
			'<p>Trace : '.$e->getTraceAsString().'</p>';
			return $return;
		}
	}
}

?>
