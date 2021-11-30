<?php 
	session_start();

	$userId = ['username' => 'admin', 'password' => 'password'];   
	
if (isset($_POST['submit'])) {

	if ($_POST['username'] === $userId['username'] && $_POST['password'] === $userId['password']) {
		$correct = 'Login Successfull';
		$_SESSION['password'] = $userId['password'] ;
		header("location: adminPanel.php");
		die();
	}else{
		$wrong = "Invalid Username or Password";
	}
}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
 	<link rel="stylesheet" href="css/kenneth_index.css?v<?php echo time(); ?>">
 	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
  <div class="container">
		<?php include_once'./inc/header.php' ?>

		<?php include_once'./inc/navbar.php' ?>

		<form action="admin.php" method="POST" class="login-form">
			<h1>Admin Login</h1>
			<input type="text" placeholder="Username" name="username">
			<input type="password" placeholder="Password" name="password">
			<input type="submit" name="submit">
			<p id="success-text"><?php echo $correct ?? ''; ?></p>
			<p id="error-text"><?php echo $wrong ?? '';?></p>
		</form>	
</div>

<?php include'./inc/footer.php' ?>
</body>
</html>