<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<!-- Optinnal auth Protect -->
<!-- PHP Logic Scrip -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>

<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container center">
    <!-- get all images -->
    <?php
      $montages = Montage::get_all();
      // var_dump($montages);
      foreach ($montages as $montage ) {
        include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/galleryDiv.php');
      }
     ?>
		<!-- Specific View Stuff -->
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
