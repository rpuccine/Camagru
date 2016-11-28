<?php
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php');

	// Page Protection
	if (!isset($_POST['src_poney']) || !isset($_POST['login'])) {
		echo ("Wrong Params Chien !");
		die;
	}
	if (!($user = User::get_user($_POST['login']))) {
		echo ("Unknown User Chien !");
		die;
	}

	// Get the img data
	list(, $data) = explode(',', $_POST['src_poney']);
	$data = base64_decode($data);
	$file_name = $user->get_user_name().'_'.time().'.png';
	$src = $_SERVER['DOCUMENT_ROOT'].'/img/'.$file_name;

	// Record the img in file system
	file_put_contents($src, $data);

	// Record the img in DB
	if (!($montage = Montage::create($user->get_id(), $src))) {
		echo ("Error in DB process");
		die;
	}

	echo "ok !!!!!";
?>
