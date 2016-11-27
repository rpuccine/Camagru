<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
	<body>
		<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
			<div class="container">
				<div style="width:50%">
					<form action="validate_sign_up.php" method="post">
						<div style="width:100%" class="padSmall">
							<label> Identifiant : <br></label>
							<input class="inputext" type="text" name="login">
						</div>
						<div style="width:100%" class="padSmall">
							<label> Mot de passe : <br></label>
							<input class="inputext" type="text" name="pwd">
						</div>
						<div style="width:100%" class="padSmall">
							<label> Confirmation Mot de passe : <br></label>
							<input class="inputext" type="text" name="cf_pwd">
						</div>
						<div style="width:100%" class="padSmall">
							<label> Email : <br></label>
							<input class="inputext" type="text" name="mail">
						</div>
						<div style="width:100%" class="padSmall">
							<input type="submit" value="Valider">
						</div>
					</form>
			</div>
		</div>
		<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>
	</body>
</html>
