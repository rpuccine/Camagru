<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php
	$limit = 5;
	$nb_montage = Montage::get_nb_montage();
	$last_page = ceil($nb_montage / $limit);
	if (!isset($_GET['page']) || $_GET['page'] < 1) {
		$page = 1;
	}
	else if ($_GET['page'] > $last_page) {
		$page = $last_page;
	}
	else {
		$page = $_GET['page'];
	}
	$offset = $page * $limit - $limit;
	$montages = Montage::get_montage_paginated($limit, $offset);
?>

<!-- Page -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<!-- Pagination -->
	<?php include($_SERVER['DOCUMENT_ROOT']
		.'/htmlBlocks/paginationGallery.php') ?>
	<!-- get all images -->
	<div class="container center">
    <?php
      foreach ($montages as $montage ) {
        include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/galleryDiv.php');
      }
     ?>
	</div>
	<!-- Pagination -->
	<?php include($_SERVER['DOCUMENT_ROOT']
		.'/htmlBlocks/paginationGallery.php') ?>
		<!-- Footer -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
