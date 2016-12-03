<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<!-- Optinnal auth Protect -->
<?php
  if (!($montage = Montage::get_montage($_POST['id']))) {
    $msg = "error";
  }
  else {
    $montage->like();
    $msg = "Liked sucess";
  }
?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container">
		<?php echo ($msg); ?>
	</div>
  <a class="container center" href="/pages/gallery.php">Retour</a>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
