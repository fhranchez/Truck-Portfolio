<?php 
	include_once ('./inc/autoloader.inc.php');
	
	use Classes\Controllers\AvailableContr;
	
	$obj = new AvailableContr();

	$obj->logout();