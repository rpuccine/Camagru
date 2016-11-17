<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Camagru</title>
<head>
<body>
	<?php
		$ret = User::sign_in($_POST['login'], $_POST['pwd']);
		if (!$ret['result']) {
			$msg = "<div><p>Error : ".$ret['data']."<p></div>";
		}
		else {
			$_SESSION['user'] = clone $ret['data'];
			$msg = "<div><p>Salut ".$_SESSION['user']->get_user_name()."<p></div>";
		}

		include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php');
		echo $msg;
	?>
	<div>
		<a href="http://localhost:8080/index.php">Retour</a>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
