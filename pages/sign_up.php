<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Camagru</title>
<head>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div>
		<form action="validate_sign_up.php" method="post">
			<div>
				<label> Identifiant : </label>
				<input class="inputext" type="text" name="login">
			</div>
			<div>
				<lanel> Mot de passe : </label>
				<input class="inputext" type="text" name="pwd">
			</div>
			<div>
				<label> Confirmation Mot de passe : </label>
				<input class="inputext" type="text" name="cf_pwd">
			</div>
			<div >
				<label> Email : </label>
				<input class="inputext" type="text" name="mail">
			</div>
			<input type="submit" value="Valider">
		</form>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
