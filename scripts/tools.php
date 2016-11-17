<?php
	function __autoload($class_name) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/classes/'.$class_name.'.php');
	}
	session_start();
?>
