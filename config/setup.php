<?php
	include("database.php");

	try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
		echo "<p>Connection with DB Established.</p>";
	} catch(PDOException $e) {
		echo "<p>Connection fail : ".$e->getMessage().".</p>";
	}

	$table_user = "DROP TABLE IF EXISTS User;
		CREATE TABLE User (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		user_name VARCHAR(30) NOT NULL,
		password VARCHAR(60) NOT NULL,
		mail VARCHAR(60) NOT NULL,
		key_val VARCHAR(60) NOT NULL,
		is_active INT(1) UNSIGNED NOT NULL
		)";

	try {
		$conn->exec($table_user);
		echo "<p>Table User (re)Created.</p>";
	} catch(PDOException $e) {
		echo "<p>Error create table_user : ".$e->getMessage().".</p>";
	}
?>
