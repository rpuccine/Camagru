<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php	include($_SERVER['DOCUMENT_ROOT'].'/scripts/auth_protect.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container">
		<h1>Account</h1>
		<div class="padSmall">
			<span>User Name : </span>
			<span><?php echo $_SESSION['user']->get_user_name()?></span>
			<a href="http://localhost:8080/pages/edit_user_name.php">Edit</a>
		</div>
		<div class="padSmall">
			<span>Mail : </span>
			<span><?php echo $_SESSION['user']->get_mail()?></span>
			<a href="http://localhost:8080/pages/edit_mail.php">Edit</a>
		</div>
		<div class="padSmall">
			<a href="http://localhost:8080/pages/edit_password.php">Edit Password</a>
		</div>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
