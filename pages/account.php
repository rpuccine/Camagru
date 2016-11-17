<?php
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php');
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/auth_protect.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Camagru</title>
<head>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div>
		<h1>Account</h1>
		<div>
			<span>User Name : </span>
			<span><?php echo $_SESSION['user']->get_user_name()?></span>
			<a href="http://localhost:8080/pages/edit_user_name.php">Edit</a>
		</div>
		<div>
			<span>Mail : </span>
			<span><?php echo $_SESSION['user']->get_mail()?></span>
			<a href="http://localhost:8080/pages/edit_mail.php">Edit</a>
		</div>
		<div>
			<a href="http://localhost:8080/pages/edit_password.php">Edit Password</a>
		</div>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
