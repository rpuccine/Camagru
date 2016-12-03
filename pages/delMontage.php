<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/auth_protect.php') ?>
<?php
 	if (!isset($_POST['id']) ||
			!(Montage::is_montage_exist($_POST['id']))) {
		header('Location: http://localhost:8080/index.php');
		exit();
	}
	if (!(Montage::del_montage($_POST['id']))) {
		$msg = "Error, Veuillez reéssayer.";
	}
	else {
		$msg = "Montage supprimé.";
	}
?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container">
		<h1>
			<?php echo ($msg); ?>
		</h1>
	</div>
	<div class="container center">
		<a href="/pages/account.php">Retour</a>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
