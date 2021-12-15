<?php 
session_start();

include('./inc/dbConn.php');

include_once ('./inc/autoloader.inc.php');

use Classes\Controllers\AvailableContr;
use Classes\Views\AvailableView;



$pdo = new PDO($dsn,$user,$pwd);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$resultPerPage = 2;

$avaView = new AvailableView();
$avaContr = new AvailableContr();

$pageCountAva = $avaContr->paginateCount();
$dataAva = $avaView->get();





// $resultPerPage = 2;

// // AVAILABLE
// $dbQueryAva = $pdo->query("SELECT COUNT(*) FROM available");
// $rowCountAva  = $dbQueryAva->fetchColumn();
// $pageCountAva = ceil($rowCountAva/$resultPerPage);


// if (!isset($_GET['page-ava'])) {
// 	$pageAva = 1;
// }else{
// 	$pageAva = $_GET['page-ava'];
// }

// $offsetAva =  ($pageAva-1)*$resultPerPage;


// TRENDING
$dbQueryTrn = $pdo->query("SELECT COUNT(*) FROM trending");
$rowCountTrn  = $dbQueryTrn->fetchColumn();
$numOfPagesTrn = ceil($rowCountTrn/$resultPerPage);


if (!isset($_GET['page-trn'])) {
	$pageTrn = 1;
}else{
	$pageTrn = $_GET['page-trn'];
}

$offsetTrn =  ($pageTrn-1)*$resultPerPage;

// RECENTLY SOLD
$dbQueryRsd = $pdo->query("SELECT COUNT(*) FROM recently_created");
$rowCountRsd  = $dbQueryRsd->fetchColumn();
$numOfPagesRsd = ceil($rowCountRsd/$resultPerPage);


if (!isset($_GET['page-rsd'])) {
	$pageRsd = 1;
}else{
	$pageRsd = $_GET['page-rsd'];
}

$offsetRsd =  ($pageRsd-1)*$resultPerPage;



$stmtTrn = $pdo->query("SELECT * FROM trending ORDER BY id desc LIMIT $offsetTrn,$resultPerPage");
$stmtRsd = $pdo->query("SELECT * FROM recently_created ORDER BY id desc LIMIT $offsetRsd,$resultPerPage");

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
			<?php while ($rowTrn = $stmtTrn->fetch()) { ?>
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
			<?php for ($page=1; $page <= $numOfPagesTrn; $page++) { ?>
					<a href="index.php?page-trn=<?php echo $page ?>" class="pag-links"><?php echo $page ?></a>
				<?php } ?>
		</div>
		<div class="sold border">
			<h2>Recently Sold</h2>
			<?php while ($rowRsd = $stmtRsd->fetch()) { ?>
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
			<?php for ($page=1; $page <= $numOfPagesRsd; $page++) { ?>
					<a href="index.php?page-rsd=<?php echo $page ?>" class="pag-links"><?php echo $page ?></a>
				<?php } ?>
		</div>
	</div>
	<?php if (!empty($_SESSION['password'])) {?>
			<div class="align-btn">
				<a class="logout" href="logout.php">Logout</a>
		</div>
	<?php } ?>
</div>

<?php include'./inc/footer.php' ?>
</body>
</html>