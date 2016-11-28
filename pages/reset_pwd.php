<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php
	$is_ok = false;
	if (!($user = User::get_user($_GET['user_name']))) {
		$msg = '<div><p>Utilisateur inconnu.</p></div>';
	}
	else if ($user->get_key_val() != $_GET['key_val']) {
		$msg = '<div><p>Lien de réinitialisation erroné.</p></div>';
	}
	else {
		$is_ok = true;
	}
?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container center">
		<?php if ($is_ok) { ?>
			<div style="width:50%">
				<form action="validate_reset_pwd.php" method="post">
					<input type="hidden" name="login" value=<?php echo $_GET['user_name'] ?>>
					<div style="width:100%" class="padSmall">
						<label> Nouveau Mot de passe : </label>
						<input class="inputext" type="text" name="pwd">
					</div>
					<div style="width:100%" class="padSmall">
						<label> Confirmation Mot de passe : </label>
						<input class="inputext" type="text" name="cf_pwd">
					</div>
					<div style="width:100%" class="padSmall">
						<input type="submit" value="Valider">
					</div>
				</form>
			</div>
		<?php } else { ?>
			<h1><?php echo $msg ?></h1>
		<?php } ?>
	</div>
	<div class="container center">
		<a href="http://localhost:8080/index.php">Retour</a>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
