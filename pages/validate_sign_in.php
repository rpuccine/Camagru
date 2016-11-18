<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container">
		<?php
			$ret = User::sign_in($_POST['login'], $_POST['pwd']);
			if (!$ret['result']) {
				$msg = "<div><p>Error : ".$ret['data']."<p></div>";
			}
			else {
				$_SESSION['user'] = clone $ret['data'];
				$msg = "<div><p>Salut ".$_SESSION['user']->get_user_name()."<p></div>";
			}

			echo $msg;
		?>
	</div>
	<div class="container center">
		<a href="http://localhost:8080/index.php">Retour</a>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
