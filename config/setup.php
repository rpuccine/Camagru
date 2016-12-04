<?php
	mkdir($_SERVER['DOCUMENT_ROOT']."/img");
	include("database.php");

	try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
		echo "<p>Connection with DB Established.</p>";
	} catch(PDOException $e) {
		echo "<p>Connection fail : ".$e->getMessage().".</p>";
	}

	$table_user = "
		DROP TABLE IF EXISTS Comment;
		DROP TABLE IF EXISTS Montage;
		DROP TABLE IF EXISTS User;
		CREATE TABLE User (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			user_name VARCHAR(30) NOT NULL,
			password VARCHAR(60) NOT NULL,
			mail VARCHAR(60) NOT NULL,
			key_val VARCHAR(60) NOT NULL,
			is_active INT(1) UNSIGNED NOT NULL
		);
		INSERT INTO User
			VALUES (NULL,
				'root',
				'$2y$10$1b6Wk6b6x2Qt59Vu49EVz.facfgyVNjVKWPmFLitQrCVcfwAEbMIC',
				'rpuccine@student.42.fr',
				'$2y$10$uEyd/AJAw3XI8PcvMM6gHOdLkAOmegAg2EpQAaRdfDERsDGAKPUXe',
				1
		);
		CREATE TABLE Montage (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			user_id INT(6) UNSIGNED NOT NULL,
			created_at DATETIME NOT NULL,
			src VARCHAR(60) NOT NULL,
			likes INT(6) UNSIGNED NOT NULL,
			FOREIGN KEY (user_id) REFERENCES User(id)
				ON DELETE CASCADE ON UPDATE CASCADE
		);
		CREATE TABLE Comment (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			montage_id INT(6) UNSIGNED NOT NULL,
			created_at DATETIME NOT NULL,
			content TEXT NOT NULL,
			FOREIGN KEY (montage_id) REFERENCES Montage(id)
				ON DELETE CASCADE ON UPDATE CASCADE
		);
		";

	try {
		$conn->exec($table_user);
		echo "<p>Data Scheme (re)Created.</p>";
	} catch(PDOException $e) {
		echo "<p>Error create table_user : ".$e->getMessage().".</p>";
	}
?>

<a href="/index.php">Retour</a>
