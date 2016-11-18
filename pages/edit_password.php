<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container">
		<form action="validate_edit_password.php" method="post">
			<div class="padSmall">
				<label> Old Password : <br></label>
				<input class="inputext" type="text" name="old_pwd">
			</div>
			<div class="padSmall">
				<label> New Password : <br></label>
				<input class="inputext" type="text" name="pwd">
			</div>
			<div class="padSmall">
				<lanel> Confirm New password : <br></label>
				<input class="inputext" type="text" name="cf_pwd">
			</div>
			<div class="padSmall">
					<input type="submit" value="Valider">
			</div>
		</form>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
