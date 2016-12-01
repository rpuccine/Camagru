<?php
	include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php');

	// Crop config
	$final_width = 320;
	$final_height = 240;
	$rect = array (
						'x' => 0,
						'y' => 0,
						'width' => $final_width,
						'height' => $final_height
	);

	// Page Protection
	if (!isset($_POST['src_poney']) || !isset($_POST['login'])) {
		echo ("Wrong Params Chien !");
		die;
	}
	if (!($user = User::get_user($_POST['login']))) {
		echo ("Unknown User Chien !");
		die;
	}

	// Build the montage file_name
	$file_name = $user->get_user_name().'_'.time().'.png';
	$dst = '/img/'.$file_name;
	$dst_file_system = $_SERVER['DOCUMENT_ROOT'].'/img/'.$file_name;

	// Use the cam picture or uploaded file
	if ($_FILES['file']['error'] == 0) {
		copy($_FILES['file']['tmp_name'], $dst_file_system);
	}
	else {
		list(, $data) = explode(',', $_POST['src_poney']);
		$data = base64_decode($data);
		file_put_contents($dst_file_system, $data);
	}

	// Get the calc src img data
	$src = $_SERVER['DOCUMENT_ROOT'].$_POST['calc'];

	// Create dest and Crop
	$dst_img = imagecreatefrompng($dst_file_system);
	$dst_img = imagecrop($dst_img, $rect);
	//Manipulate the image
	$src_img = imagecreatefrompng($src);
	$src_w = imagesx($src_img);
	$src_h = imagesy($src_img);
	$dst_w = imagesx($dst_img);
	$dst_h = imagesy($dst_img);
	$dst_x = $dst_w / 2 - $src_w / 2;
	$dst_y = $dst_h / 2 - $src_h / 2;
	// Do the copy
	if (!imagecopy ($dst_img, $src_img, $dst_x, $dst_y, 0, 0, $src_w , $src_h)) {
		echo ("Error in copy proccess...");
		die;
	}
	// Record le montage
	if (!imagepng($dst_img, $dst_file_system)) {
		echo ("Error in record montage...");
		die;
	}

	// Record the img in DB
	if (!($montage = Montage::create($user->get_id(), $dst))) {
		echo ("Error in DB process");
		die;
	}

	echo ($dst);
?>
