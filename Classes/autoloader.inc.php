<?php 
//Works without namespace
spl_autoload_register(function($className) {
	$path = __DIR__ . DIRECTORY_SEPARATOR . $className . '.class.php';
	// $file = str_replace('\\', DIRECTORY_SEPARATOR, $path);
	if (file_exists($path)) {
		include $path;
	}else{
		echo 'class not found';
	}
});