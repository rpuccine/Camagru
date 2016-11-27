<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container">
		<form action="validate_edit_mail.php" method="post">
			<div class="padSmall">
				<label> New Mail : <br></label>
				<input class="inputext" type="text" name="mail">
			</div>
			<div class="padSmall">
				<lanel> Confirm with your password : <br></label>
				<input class="inputext" type="password" name="pwd">
			</div>
			<div class="padSmall">
				<input type="submit" value="Valider">
			</div>
		</form>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
</body>
</html>
