<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Camagru</title>
<head>
<body>
	<?php
		if (isset($_SESSION['user'])) {
			unset($_SESSION['user']);
			$msg = '<div><h1>Vous etes bien deconnecte</h1></div>';
		}
		else {
			$msg = '<div><h1>Vous etes deja deconnecte</h1></div>';
		}

		include($_SERVER['DOCUMENT_ROOT']."/htmlBlocks/IncognitoHeader.php");
		echo $msg;
		include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php');
	?>
</body>
</html>
