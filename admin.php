<?php 
include_once ('./inc/autoloader.inc.php');

use Classes\Controllers\AvailableContr;

$obj = new AvailableContr();

$alerts = $obj->cookiesFunc();
 ?>

	<?php include_once'./inc/header.php' ?>

	<?php include_once'./inc/navbar.php' ?>

	<form action="admin.php" method="POST" class="login-form">
		<h1>Admin Login</h1>
		<input type="text" placeholder="Username" name="username">
		<input type="password" placeholder="Password" name="password">
		<input type="submit" name="submitAdmin">
		<p id="success-text"><?php echo $alerts['success'] ?? ''; ?></p>
		<p id="error-text"><?php echo $alerts['error'] ?? '';?></p>
	</form>	

<?php include'./inc/footer.php' ?>
