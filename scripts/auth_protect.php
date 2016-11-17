<?php
	if (!isset($_SESSION['user'])) {
		header('Location: http://localhost:8080/pages/forbidden_access.php');
		exit();
	}
?>
