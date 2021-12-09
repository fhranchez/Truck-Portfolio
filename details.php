<?php
session_start();

include('./inc/dbConn.php');
include_once('inc/autoloader.inc.php');

use Classes\Controllers\AvailableContr;
use Classes\Views\AvailableView;

$pdo = new PDO($dsn,$user,$pwd);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (isset($_GET['trn-id'])) {

	$idTrn = $_GET['trn-id'];
	$sqlTrn = "SELECT * FROM trending WHERE id =:id";
	$stmtTrn = $pdo->prepare($sqlTrn);
	$stmtTrn->execute(['id' => $idTrn]);
	$dataTrn = $stmtTrn->fetchAll();
}

if (isset($_GET['rsd-id'])) {

	$idRsd = $_GET['rsd-id'];
	$sqlRsd = "SELECT * FROM recently_created WHERE id =:id";
	$stmtRsd = $pdo->prepare($sqlRsd);
	$stmtRsd->execute(['id' => $idRsd]);
	$dataRsd = $stmtRsd->fetchAll();
}


$avaContr = new AvailableContr();
$avaView = new AvailableView();

// DIsplaying a Single Row
$dataAva = $avaView->getSingleId();

//Deleting Data
$avaContr->deleteSingleId();


if (isset($_POST['deleteTrn'])) {
	$idTrn = $_POST['id_to_deleteTrn'];
	$sqlTrn = "DELETE FROM trending WHERE id = :id";
	$stmtTrn = $pdo->prepare($sqlTrn);
	$stmtTrn->execute(['id' => $idTrn]);
}

if (isset($_POST['deleteRsd'])) {
	$idRsd = $_POST['id_to_deleteRsd'];
	$sqlRsd = "DELETE FROM recently_created WHERE id = :id";
	$stmtRsd = $pdo->prepare($sqlRsd);
	$stmtRsd->execute(['id' => $idRsd]);
}

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