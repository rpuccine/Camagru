<?php
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php');
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/auth_protect.php');

	// Verif PWD
	if (!password_verify($_POST['pwd'], $_SESSION['user']->get_password())) {
		$msg = "<p> Incorrect Password <p>";
	}
	// Verif Mail
	else if (!preg_match('/^[\w\.-]+@[\w\.-]+\.[a-z]{2,3}$/i', $_POST['mail'])) {
		$msg = "<p> Desole petit chat, ce mail est incorrect :( <p>";
	}
	// Update Mail
	else if ($_SESSION['user']->set_mail($_POST['mail'])) {
		$msg = "<p> Here your cute new Mail : ".$_POST['mail']." ! <p>";
	}
	else {
		$msg = "<p> Error fatale bitch <p>";
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
