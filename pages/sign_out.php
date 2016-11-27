<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container center">
		<div style="width:50%" class="center">
			<?php
				if (isset($_SESSION['user'])) {
					unset($_SESSION['user']);
					$msg = '<div><h1>Vous êtes bien deconnecté</h1></div>';
				}
				else {
					$msg = '<div><h1>Vous êtes déjà deconnecté</h1></div>';
				}
				echo $msg;
			?>
		</div>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php'); ?>
</body>
</html>
