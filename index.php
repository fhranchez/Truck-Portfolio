<?php 
include_once ('./inc/autoloader.inc.php');

use Classes\Controllers\AvailableContr;
use Classes\Views\AvailableView;

use Classes\Controllers\TrendingContr;
use Classes\Views\TrendingView;

use Classes\Controllers\RsdContr;
use Classes\Views\RsdView;


// AVAILABLE
$avaView = new AvailableView();
$avaContr = new AvailableContr();

$avaContr->cookiesFunc();
$pageCountAva = $avaContr->paginateCount();
$dataAva = $avaView->get();


// TRENDING
$trnView = new TrendingView();
$trnContr = new TrendingContr();

$pageCountTrn = $trnContr->paginateCount();
$dataTrn = $trnView->get();



// RECENTLY SOLD
$rsdview = new RsdView();
$rsdContr = new RsdContr();

$pageCountRsd = $rsdContr->paginateCount();
$dataRsd = $rsdview->get();

?>

	<?php include'./inc/header.php' ?>

	<?php include'./inc/navbar.php' ?>

	<div class="content">
		<div class="available border">
			<h2>Available</h2>
			<?php while ($rowAva = $dataAva->fetch()) { ?>
				<img src="img/<?php echo $rowAva['image']; ?>" alt="truck">
				<p>Description: <strong><?php echo htmlspecialchars($rowAva['description']); ?></strong></p>
				<p>Price: <strong>₦<?php echo htmlspecialchars($rowAva['price']); ?></strong></p>
				<p>Phone: <strong><?php echo htmlspecialchars($rowAva['phone']); ?></strong></p>
				<div class="buttons">
					<p><a href="details.php?ava-id=<?php echo $rowAva['id'] ?>">More Info</a></p>
					<?php if (isset($_SESSION['password'])) : ?>
						<p><a href="update.php?ava-id=<?php echo $rowAva['id'] ?>" class="edit-info">Edit Info</a><p>
					<?php endif ?>			
				</div>
			<?php } ?>
				<?php for ($page=1; $page <= $pageCountAva; $page++) { ?>
					<a href="index.php?page-ava=<?php echo $page ?>" class="pag-links"><?php echo $page ?></a>
				<?php } ?>
		</div>
		<div class="trending border">
			<h2>Trending</h2>
			<?php while ($rowTrn = $dataTrn->fetch()) { ?>
			<img src="img/<?php echo $rowTrn['image']; ?>" alt="truck">
			<p>Description: <strong><?php echo htmlspecialchars($rowTrn['description']); ?></strong></p>
			<p>Price: <strong>₦<?php echo htmlspecialchars($rowTrn['price']); ?></strong></p>
			<p>Phone: <strong><?php echo htmlspecialchars($rowTrn['phone']); ?></strong></p>
			<div class="buttons">
				<p><a href="details.php?trn-id=<?php echo $rowTrn['id'] ?>">More Info</a></p>
				<?php if (isset($_SESSION['password'])) : ?>
					<p><a href="update.php?trn-id=<?php echo $rowTrn['id'] ?>" class="edit-info">Edit Info</a><p>
				<?php endif ?>
			</div>
			<?php } ?>
			<?php for ($page=1; $page <= $pageCountTrn; $page++) { ?>
					<a href="index.php?page-trn=<?php echo $page ?>" class="pag-links"><?php echo $page ?></a>
				<?php } ?>
		</div>
		<div class="sold border">
			<h2>Recently Sold</h2>
			<?php while ($rowRsd = $dataRsd->fetch()) { ?>
			<img src="img/<?php echo $rowRsd['image']; ?>" alt="truck">
			<p>Description: <strong><?php echo htmlspecialchars($rowRsd['description']); ?></strong></p>
			<p>Price: <strong>₦<?php echo htmlspecialchars($rowRsd['price']); ?></strong></p>
			<p>Phone: <strong><?php echo htmlspecialchars($rowRsd['phone']); ?></strong></p>
			<div class="buttons">
				<p><a href="details.php?rsd-id=<?php echo $rowRsd['id'] ?>">More Info</a></p>
				<?php if (isset($_SESSION['password'])) : ?>
					<p><a href="update.php?rsd-id=<?php echo $rowRsd['id'] ?>" class="edit-info">Edit Info</a><p>
				<?php endif ?>			
			</div>
			<?php } ?>
			<?php for ($page=1; $page <= $pageCountRsd; $page++) { ?>
					<a href="index.php?page-rsd=<?php echo $page ?>" class="pag-links"><?php echo $page ?></a>
				<?php } ?>
		</div>
	</div>
	<?php $avaContr->logoutBtn() ?>
</div>

<?php include'./inc/footer.php' ?>