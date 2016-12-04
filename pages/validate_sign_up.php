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
	else if (!preg_match('@[0-9]@', $_POST['pwd']) || strlen($_POST['pwd']) >= 8) {
		$msg = "<p> Le mot de passe doit contenir au moins 8 characteres et un chiffre <p>";
	}
	else if ($_POST['pwd'] !== $_POST['cf_pwd']) {
		$msg = "<p> Veuillez verifier l'unicite du password <p>";
	}
	// Create User
	else {
		$user = User::create($_POST['login'],
			$_POST['pwd'],
			$_POST['mail']);

		if ($user) {
			if ($user->send_verif_mail()) {
				$msg = "<p> Votre compte a bien ete cree.</p>".
				"<p>Pour activer celui-ci, verifiez vos mail, un lien d'activation vous a ete envoye.</p>";
			}
			else {
				$msg = "<p> Votre compte a bien ete cree.</p>".
				"<p>Mais une erreur est survenue dans l'envois du mail d'activation.</p>";
			}
		}
		else {
			$msg = "<p> Une erreur est survenue. <p>";
		}
	}
?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container center">
		<h1><?php echo $msg ?></h1>
	</div>
	<div class="container center">
		<a href="/index.php">Retour</a>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
