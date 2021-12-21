<?php
include_once('inc/autoloader.inc.php');

use Classes\Controllers\AvailableContr;
use Classes\Views\AvailableView;

use Classes\Controllers\TrendingContr;
use Classes\Views\TrendingView;

use Classes\Controllers\RsdContr;
use Classes\Views\RsdView;


//AVAILABLE
$avaContr = new AvailableContr();
$avaView = new AvailableView();

//Cookies
$avaContr->cookiesFunc();
// DIsplaying a Single Row
$dataAva = $avaView->getId();
//Deleting Data
$avaContr->delete();



//TRENDING
$TrnContr = new TrendingContr();
$trnView = new TrendingView();
// DIsplaying a Single Row
$dataTrn = $trnView->getId();
//Deleting Data
$TrnContr->delete();



// RECENTLY SOLD
$RsdContr = new RsdContr();
$rsdView = new RsdView();
// DIsplaying a Single Row
$dataRsd = $rsdView->getId();
//Deleting Data
$RsdContr->delete();


$sess = $_SESSION['password'] ?? ''
?>


<?php include_once'./inc/header.php' ?>

<?php include_once'./inc/navbar.php' ?>

		<?php if (isset($_GET['ava-id'])) {?>
		<?php if ($dataAva) { ?>
		<?php foreach ($dataAva as $postAva) { ?>
		<div class="details-cont border">
			<h1>Available</h1>
			<img src="img/<?php echo $postAva['image']; ?>" alt="<?php $postAva['img_dir'] ?>">
			<p>Description: <?php echo $postAva['description']; ?></p>
			<p>Price: <?php echo $postAva['price']; ?></p>			
			<p>Phone: <?php echo $postAva['phone']; ?></p>
			<form action="details.php" method="POST">
			<?php if (!empty($_SESSION['password'])) { ?>
	 			<input type="hidden" name="id_to_deleteAva" value="<?php echo $postAva['id'] ?>">
	 			<input type="submit" class="del-btn" name="deleteAva" value="Delete">
 			<?php } ?>
	 		</form>
	</div>
		<?php } ?>
	<?php } ?>
<?php } ?>

		<?php if (isset($_GET['trn-id'])) {?>
		<?php if ($dataTrn) { ?>
			<?php foreach ($dataTrn as $postTrn) { ?>
			<div class="details-cont border">
				<h1>Trending</h1>
				<img src="img/<?php echo $postTrn['image']; ?>" alt="<?php $postTrn['img_dir'] ?>">
				<p>Description: <?php echo $postTrn['description']; ?></p>
				<p>Price: <?php echo $postTrn['price']; ?></p>			
				<p>Phone: <?php echo $postTrn['phone']; ?></p>
				<form action="details.php" method="POST">
	 			<?php if (!empty($_SESSION['password'])) { ?>
	 			<input type="hidden" name="id_to_deleteTrn" value="<?php echo $postTrn['id'] ?>">
	 			<input type="submit" class="del-btn" name="deleteTrn" value="Delete">	
		 		
		 		<?php } ?>
		 		</form>
		 	
		</div>
		<?php } ?>
	<?php } ?>
<?php } ?>

		<?php if (isset($_GET['rsd-id'])) {?>
		<?php if ($dataRsd) { ?>
			<?php foreach ($dataRsd as $postRsd) { ?>
			<div class="details-cont border">
				<h1>Recently Sold</h1>
				<img src="img/<?php echo $postRsd['image']; ?>" alt="<?php $postRsd['img_dir'] ?>">
				<p>Description: <?php echo $postRsd['description']; ?></p>
				<p>Price: <?php echo $postRsd['price']; ?></p>			
				<p>Phone: <?php echo $postRsd['phone']; ?></p>
				<form action="details.php" method="POST">
					<?php if (!empty($_SESSION['password'])) { ?>
	 			<input type="hidden" name="id_to_deleteRsd" value="<?php echo $postRsd['id'] ?>">
	 			<input type="submit" class="del-btn" name="deleteRsd" value="Delete">

	 			<?php } ?>	
		 		</form>
		</div>
		<?php } ?>
	<?php } ?>
<?php } ?>


<?php include'./inc/footer.php' ?>
</body>
</html>