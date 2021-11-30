<div class="navbar">
		<li><a href="index.php">Home</a></li>
 		<li><a href="about.php">About</a></li>
 		<li><a href="contact.php">Contact</a></li>
 		<li><a href="admin.php">Admin</a></li>
 		<?php if (!empty($_SESSION['password'])) {?>
 		<p>Welcome, <a class="adm-btn" href="adminPanel.php">Admin</a></p>
 		<img src="img/login_icon.png" alt="login icon">
 	<?php } ?>
	</div>