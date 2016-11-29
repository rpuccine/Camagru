<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php
	if (!($user = User::get_user($_GET['user_name']))) {
		$msg = '<div><p>Utilisateur inconnu.</p></div>';
	}
	else if ($user->get_is_active()) {
		header('Location: http://localhost:8080');
		exit();
	}
	else if ($user->get_key_val() != $_GET['key_val']) {
		$msg = '<div><p>Lien d\'activation erroné.</p></div>';
	}
	else if ($user->set_is_active(1)) {
		$_SESSION['user'] = clone $user;
		$msg = '<div><p>Bravo '.$_SESSION['user']->get_user_name().
			', ton compte est maintenant Actif !</p>'.
			'<p> Vole de tes propres ailes !!!</p></div>';
	}
	else {
		$msg = "<div><p>Desole, une erreur est survenue</p></div>";
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
