<?php
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php');

	$ret = User::sign_in($_POST['login'], $_POST['pwd']);
	if (!$ret['result']) {
		$msg = "<div><p>Error :</p>".$ret['data']."</div>";
	}
	else {
		$_SESSION['user'] = clone $ret['data'];
		$msg = "<div><p>Bienvenue ".$_SESSION['user']->get_user_name()." !</p></div>";
	}
?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container">
		<h1><?php echo $msg ?></h1>
	</div>
	<div class="container center">
		<a href="http://localhost:8080/index.php">Retour</a>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
