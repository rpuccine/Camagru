<?php
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php');
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/auth_protect.php');

	// Verif Old PWD
	if (!password_verify($_POST['old_pwd'], $_SESSION['user']->get_password())) {
		$msg = "<p> Incorrect Old Password <p>";
	}
	// Verif New PWD
	else if ($_POST['pwd'] !== $_POST['cf_pwd']) {
		$msg = "<p> Veuillez verifier l'unicite du nouveau password <p>";
	}
	// Update PWD
	else if ($_SESSION['user']->set_password($_POST['pwd'])) {
		$msg = "<p> Here your cute new Hash_pwd : ".$_SESSION['user']->get_password()." ! <p>";
	}
	else {
		$msg = "<p> Error fatale bitch <p>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Camagru</title>
<head>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div>
		<h1><?php echo $msg ?></h1>
	</div>
	<div>
		<a href="http://localhost:8080/index.php">Retour</a>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
