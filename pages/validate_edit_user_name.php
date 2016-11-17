<?php
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php');
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/auth_protect.php');

	// Verif PWD
	if (!password_verify($_POST['pwd'], $_SESSION['user']->get_password())) {
		$msg = "<p> Incorrect Password <p>";
	}
	// Verif Login
	else if (User::is_user_name_exist($_POST['login'])) {
		$msg = "<p> Desole petit chat, ce nom d'utilisateur est deja pris :( <p>";
	}
	// Update User Name
	else if ($_SESSION['user']->set_user_name($_POST['login'])) {
		$msg = "<p> Here your cute new User Name : ".$_POST['login']." ! <p>";
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
