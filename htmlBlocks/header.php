<header>
	<div class="container">
	<?php
		if (isset($_SESSION['user'])) {
			include($_SERVER['DOCUMENT_ROOT']."/htmlBlocks/connectedHeader.php");
		}
		else
			include($_SERVER['DOCUMENT_ROOT']."/htmlBlocks/IncognitoHeader.php");
	?>
	</div>
</header>
