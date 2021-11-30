<?php 
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
 	<link rel="stylesheet" href="css/kenneth_index.css?v<?php echo time(); ?>">
 	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
  <div class="container">
	<?php include'./inc/header.php' ?>

	<?php include'./inc/navbar.php' ?>


	<div class="about-content">
		<img src="./img/logo.jpg" alt="logo">
		<p>KNG Autos is a certified truck servicing company in abuja that specialize in the sales of truck servicing parts and truck spare parts such as M.A.N, Mercedes, Howo, MACK and lot's more</p>
		<p>We also connect busy business owners with their needs such as the sale of used trucks for sale</p>
		<p>We also advertise trucks for sale through our platform for prospective buyers to grow their business</p>
		<p>We are a registered company with rc number <strong>1712733</strong> and we do legit business with our clients</p>

	</div>
	
</div>

<?php include'./inc/footer.php' ?>
</body>
</html>