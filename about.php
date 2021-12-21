<?php 
include_once ('./inc/autoloader.inc.php');

use Classes\Controllers\AvailableContr;

$obj = new AvailableContr();
$obj->cookiesFunc();

 ?>

	<?php include'./inc/header.php' ?>

	<?php include'./inc/navbar.php' ?>


	<div class="about-content">
		<img src="./img/logo.jpg" alt="logo">
		<p>KNG Autos is a certified truck servicing company in abuja that specialize in the sales of truck servicing parts and truck spare parts such as M.A.N, Mercedes, Howo, MACK and lot's more</p>
		<p>We also connect busy business owners with their needs such as the sale of used trucks for sale</p>
		<p>We also advertise trucks for sale through our platform for prospective buyers to grow their business</p>
		<p>We are a registered company with rc number <strong>1712733</strong> and we do legit business with our clients</p>

	</div>

<?php include'./inc/footer.php' ?>
