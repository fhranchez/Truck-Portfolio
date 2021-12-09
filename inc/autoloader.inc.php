<?php
//Works With Namespace 
spl_autoload_register(function($className) {
	$path = __DIR__ . '\\..\\' .  $className . '.class.php';
	$file = str_replace('\\', DIRECTORY_SEPARATOR, $path);

	if (file_exists($file)) {
		include $file;
	}else{
		echo 'class not found';
	}
});