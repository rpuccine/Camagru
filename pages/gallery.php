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

<script type="text/javascript">
(function() {

	// recupere la collection de like_form
	var form_like_class = document.getElementsByClassName("form_like");
	// def la function ajax pour chaque form
	for (var i = 0; i < form_like_class.length; i++) {
	  form_like_class[i].addEventListener('submit', function(ev) {
			//  html var
			var montage_id = this.elements.namedItem("id").value;
			var span_id = "#like_" + montage_id;
			var span = document.querySelector(span_id);
			//  ajax var
			var request = new XMLHttpRequest();
			var url = "/scripts/likeMontage.php";
			var form_data = new FormData(this);
			request.open("POST", url, true);
			//  handle response
			request.onreadystatechange = function() {
				if (request.readyState == 4 && (request.status == 200 || request.status == 0)) {
					//alert(request.responseText);
					var response = request.responseText;
					if (response != 'error') {
						span.innerHTML = response;
					}
					else {
						alert("Error during like process");
					}
				}
			}
			//  send data
			request.send(form_data);
			ev.preventDefault();
		}, false);
	}

	// recupere la collection de comment_form
	var form_comment_class = document.getElementsByClassName("form_comment");
	// def la function ajax pour chaque form
	for (var i = 0; i < form_comment_class.length; i++) {
	  form_comment_class[i].addEventListener('submit', function(ev) {
			//  html var
			var form = this;
			var montage_id = this.elements.namedItem("montage_id").value;
			var content = this.elements.namedItem("content").value;
			var list_id = "#list_comment_" + montage_id;
			var list = document.querySelector(list_id);
			//  ajax var
			var request = new XMLHttpRequest();
			var url = "/scripts/postComment.php";
			var form_data = new FormData(this);
			request.open("POST", url, true);
			//  handle response
			request.onreadystatechange = function() {
				if (request.readyState == 4 && (request.status == 200 || request.status == 0)) {
					//alert(request.responseText);
					var response = request.responseText;
					if (response != 'error') {
						var node = document.createElement("P");
						node.innerHTML = content;
						list.insertBefore(node, list.childNodes[0]);
						form.elements.namedItem("content").value = "";
					}
					else {
						alert("Error during postComment process");
					}
				}
			}
			//  send data
			request.send(form_data);
			ev.preventDefault();
		}, false);
	}



})();
</script>

</body>
</html>
