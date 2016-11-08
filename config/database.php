<?php
	$DB_DSN = "mysql:host=localhost;port=3307;dbname=camagru";
	$DB_USER = "root";
	$DB_PASSWORD = "root";
	$DB_OPTIONS = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

	try {
		$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPTIONS);
		echo "Connection sucess";
	} catch(PDOException $e) {
		echo "Connection fail".$e->getMessage();
		var_dump(PDO::getAvailableDrivers());
	}
?>
