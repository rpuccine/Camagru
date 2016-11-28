<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>

<?php
	if (!($user = User::get_user($_POST['login']))) {
		$msg = "<p>Désolé, l'utilisateur ".$_POST['login']." est inconnu.</p>";
	}
	else if ($user->send_reset_pwd_mail()){
		$msg = "<p>Un mail contenant un lien pour reinitialiser"
			." votre mot de passe vous a été envoyé.</p>";
	}
	else {
		$msg = "<p>Une erreur est survenue, veuillez réessayer.</p>";
	}
?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container center">
		<h1><?php echo $msg ?></h1>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>

