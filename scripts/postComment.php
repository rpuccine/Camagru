<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<!-- Optinnal auth Protect -->
<?php
  $montage_id = $_POST['montage_id'];
  $content = $_POST['content'];
  if (!(Comment::post($montage_id, $content))) {
    $msg = "error";
  }
  else {
    $msg = "post sucess";
  }

  if (!($user = User::get_user_by_id($_POST['user_id']))) {
    $msg2 = "User not find";
  }
  else if (!($user->send_comment_notif_mail())) {
    $msg2 = "mail failed";
  }
  else {
    $msg2 = "Mail send";
  }
?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container">
		<p><?php echo ($msg); ?></p>
		<p><?php echo ($msg2); ?></p>
	</div>
  <a class="container center" href="/pages/gallery.php">Retour</a>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
