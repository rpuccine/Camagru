<header>
	<div class="container">
		<div style="width:19%;" class="center">
			<a href="/">Home</a>
		</div>
		<div style="width:20%;" class="center">
			<a href="#">Galeries</a>
		</div>
		<div style="width:20%;" class="center">
			<a href="http://localhost:8080/pages/montage.php">Montage</a>
		</div>
	<?php
		if (isset($_SESSION['user'])) {
			include($_SERVER['DOCUMENT_ROOT']."/htmlBlocks/connectedHeader.php");
		}
		else
			include($_SERVER['DOCUMENT_ROOT']."/htmlBlocks/IncognitoHeader.php");
	?>
	</div>
</header>
