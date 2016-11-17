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
		<form action="validate_edit_password.php" method="post">
			<div>
				<label> Old Password : </label>
				<input class="inputext" type="text" name="old_pwd">
			</div>
			<div>
				<label> New Password : </label>
				<input class="inputext" type="text" name="pwd">
			</div>
			<div>
				<lanel> Confirm New password : </label>
				<input class="inputext" type="text" name="cf_pwd">
			</div>
			<input type="submit" value="Valider">
		</form>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
