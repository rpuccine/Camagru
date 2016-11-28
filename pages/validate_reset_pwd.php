<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<!-- Optinnal auth Protect -->
<?php
	// Verif and get User
	if (!($user = User::get_user($_POST['login']))) {
		$msg = '<div><p>Utilisateur inconnu.</p></div>';
	}
	// Verif PWD
	else if ($_POST['pwd'] !== $_POST['cf_pwd']) {
		$msg = "<p> Veuillez verifier l'unicite du password <p>";
	}
	// Update PWD
	else if ($user->set_password($_POST['pwd'])){
		$msg = "<p>Votre mot de passe a bien été mis à jour.<br>".
			"Utilisez le dès maintenant pour vous connecter.<p>";
	}
	else {
		$msg = "<p>Une erreur est survenue, veuillez réessayer.</p>";
	}
?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container">
		<h1><?php echo $msg ?></h1>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>

