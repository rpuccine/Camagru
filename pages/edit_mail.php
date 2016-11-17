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
		<form action="validate_edit_mail.php" method="post">
			<div>
				<label> New Mail : </label>
				<input class="inputext" type="text" name="mail">
			</div>
			<div>
				<lanel> Confirm with your password : </label>
				<input class="inputext" type="text" name="pwd">
			</div>
			<input type="submit" value="Valider">
		</form>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
