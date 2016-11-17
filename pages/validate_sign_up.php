<?php
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php');

	// Verif login
	if (User::is_user_name_exist($_POST['login'])) {
		$msg = "<p> Desole petit chat, ce nom d'utilisateur est deja pris :( <p>";
	}
	// Verif Mail
	else if (!preg_match('/^[\w\.-]+@[\w\.-]+\.[a-z]{2,3}$/i', $_POST['mail'])) {
		$msg = "<p> Desole petit chat, ce mail est incorrect :( <p>";
	}
	// Verif PWD
	else if ($_POST['pwd'] !== $_POST['cf_pwd']) {
		$msg = "<p> Veuillez verifier l'unicite du password <p>";
	}
	// Create User
	else {
		$user = User::create($_POST['login'],
			$_POST['pwd'],
			$_POST['mail']);

		if ($user)
			$msg = "<p> User created bitch <p>";
		else
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
		<?php echo $msg ?>
	</div>
	<div>
		<a href="http://localhost:8080/index.php">Retour</a>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
