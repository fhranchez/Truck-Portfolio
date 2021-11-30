<?php
session_start();
$sess = $_SESSION['password'] ?? '';
if (!$sess) {
	echo '<script language="javascript">window.location="admin.php";</script>'; die();
}

include('./inc/dbConn.php');


$pdo = new PDO($dsn,$user,$pwd);

$fetchId = $_GET['ava-id'] ?? ''; 
$fetchSql = "SELECT * FROM available WHERE id = :id";
$fetchStmt = $pdo->prepare($fetchSql);
$fetchStmt->execute(['id' => $fetchId]);

$result = $fetchStmt->fetchAll();


$fetchIdTrn = $_GET['trn-id'] ?? ''; 
$fetchSqlTrn = "SELECT * FROM trending WHERE id = :id";
$fetchStmtTrn = $pdo->prepare($fetchSqlTrn);
$fetchStmtTrn->execute(['id' => $fetchIdTrn]);

$resultTrn = $fetchStmtTrn->fetchAll();

$fetchIdRsd = $_GET['rsd-id'] ?? ''; 
$fetchSqlRsd = "SELECT * FROM recently_created WHERE id = :id";
$fetchStmtRsd = $pdo->prepare($fetchSqlRsd);
$fetchStmtRsd->execute(['id' => $fetchIdRsd]);

$resultRsd = $fetchStmtRsd->fetchAll();


if (isset($_POST['submit'])) {
	$id = $_GET['ava-id'] ?? '';
	$des = trim($_POST['description'] ?? '');
	$price = trim($_POST['price'] ?? '');
	$phone = trim($_POST['phone'] ?? '');
	$imageAva = $_FILES['imgAva']['name'] ?? '';
 	$imgPath = "img/". basename($imageAva);


	//form validation
 	if (empty($des) || empty($price) || empty($phone) || empty($imageAva)) {
 		$error = '*All fields are required*';
 	}else {
 		$sql = "UPDATE available SET description = :des, price = :price, image = :image, phone = :phone WHERE id = :id";
 		$stmt = $pdo->prepare($sql); 
 		$stmt->execute(['des' => $des, 'price' => $price, 'image' => $imageAva, 'phone' => $phone, 'id' => $id]);

 		if (!move_uploaded_file($_FILES['imgAva']['tmp_name'], $imgPath)) {
	  		$msg = "Failed to upload image";
	  	}
	  	$success = 'file uploaded successfully';
 	}
 }

 if (isset($_POST['submit-trn'])) {
	$idTrn = $_GET['trn-id'] ?? '';
	$desTrn = trim($_POST['description-trn'] ?? '');
	$priceTrn = trim($_POST['price-trn'] ?? '');
	$phoneTrn = trim($_POST['phone-trn'] ?? '');
	$imageTrn = $_FILES['imgTrn']['name'] ?? '';
 	$imgPathTrn = "img/". basename($imageTrn);


	//form validation
 	if (empty($desTrn) || empty($priceTrn) || empty($phoneTrn) || empty($imageTrn)) {
 		$errorTrn = '*All fields are required*';
 	}else {
 		$sqlTrn = "UPDATE trending SET description = :des, price = :price, image = :image, phone = :phone WHERE id = :id";
 		$stmtTrn = $pdo->prepare($sqlTrn); 
 		$stmtTrn->execute(['des' => $desTrn, 'price' => $priceTrn, 'image' => $imageTrn, 'phone' => $phoneTrn, 'id' => $idTrn]);

 		if (!move_uploaded_file($_FILES['imgTrn']['tmp_name'], $imgPathTrn)) {
	  		$msgTrn = "Failed to upload image";
	  	}
	  	$successTrn = 'file uploaded successfully';
 	}
 }

 if (isset($_POST['submit-rsd'])) {
	$idRsd = $_GET['rsd-id'] ?? '';
	$desRsd = trim($_POST['description-rsd'] ?? '');
	$priceRsd = trim($_POST['price-rsd'] ?? '');
	$phoneRsd = trim($_POST['phone-rsd'] ?? '');
	$imageRsd = $_FILES['imgRsd']['name'] ?? '';
 	$imgPathRsd = "img/". basename($imageRsd);


	//form validation
 	if (empty($desRsd) || empty($priceRsd) || empty($phoneRsd) || empty($imageRsd)) {
 		$errorRsd = '*All fields are required*';
 	}else {
 		$sqlRsd = "UPDATE recently_created SET description = :des, price = :price, image = :image, phone = :phone WHERE id = :id";
 		$stmtRsd = $pdo->prepare($sqlRsd); 
 		$stmtRsd->execute(['des' => $desRsd, 'price' => $priceRsd, 'image' => $imageRsd, 'phone' => $phoneRsd, 'id' => $idRsd]);

 		if (!move_uploaded_file($_FILES['imgRsd']['tmp_name'], $imgPathRsd)) {
	  		$msgRsd = "Failed to upload image";
	  	}
	  	$successRsd = 'file uploaded successfully';
 	}
 } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update Info</title>
	<link rel="stylesheet" href="css/kenneth_index.css?v<?php echo time(); ?>">
 	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<div class="container">
		<?php include'./inc/header.php' ?>
		<?php include'./inc/navbar.php' ?>
		<form action="" method="POST" class="update-cont border" enctype="multipart/form-data">
			<h2>Update Data</h2>
			<?php if (isset($_GET['ava-id'])): ?>
				<?php foreach($result as $data) : ?> 
					<input 
						type="text" 
						placeholder="Description"
						name="description"
						value="<?php echo htmlspecialchars($data['description']) ?>"
					>
					<input 
						type="text" 
						placeholder="Price" 
						name="price"
						value="<?php echo htmlspecialchars($data['price']) ?>" 
					>
					<input 
						type="text" 
						placeholder="Phone" 
						name="phone"
						value="<?php echo htmlspecialchars($data['phone']) ?>" 					
					>
					<input type="hidden" name="size" value="1000000">
					<input type="file" name="imgAva" accept="image/*" >
					<input type="submit" value="Edit" name="submit">
				<?php endforeach ?>
			<?php endif ?>
					<p id="error-text"><?php echo $error ?? '' ?></p>
					<p id="error-text"><?php echo $msg ?? '' ?></p>
				<p id="success-text"><?php echo $success ?? '' ?></p>

<!-- Trending -->

				<?php if (isset($_GET['trn-id'])): ?>
				<?php foreach($resultTrn as $dataTrn) : ?> 
					<input 
						type="text" 
						placeholder="Description"
						name="description-trn"
						value="<?php echo htmlspecialchars($dataTrn['description']) ?>"
					>
					<input 
						type="text" 
						placeholder="Price" 
						name="price-trn"
						value="<?php echo htmlspecialchars($dataTrn['price']) ?>" 
					>
					<input 
						type="text" 
						placeholder="Phone" 
						name="phone-trn"
						value="<?php echo htmlspecialchars($dataTrn['phone']) ?>" 					
					>
					<input type="hidden" name="size" value="1000000">
					<input type="file" name="imgTrn" accept="image/*" >
					<input type="submit" value="Edit" name="submit-trn">
				<?php endforeach ?>
			<?php endif ?>
					<p id="error-text"><?php echo $errorTrn ?? '' ?></p>
					<p id="error-text"><?php echo $msgTrn ?? '' ?></p>
					<p id="success-text"><?php echo $successTrn ?? '' ?></p>

<!-- Recently Sold -->
				<?php if (isset($_GET['rsd-id'])): ?>
				<?php foreach($resultRsd as $dataRsd) : ?> 
					<input 
						type="text" 
						placeholder="Description"
						name="description-rsd"
						value="<?php echo htmlspecialchars($dataRsd['description']) ?>"
					>
					<input 
						type="text" 
						placeholder="Price" 
						name="price-rsd"
						value="<?php echo htmlspecialchars($dataRsd['price']) ?>" 
					>
					<input 
						type="text" 
						placeholder="Phone" 
						name="phone-rsd"
						value="<?php echo htmlspecialchars($dataRsd['phone']) ?>" 					
					>
					<input type="hidden" name="size" value="1000000">
					<input type="file" name="imgRsd" accept="image/*" >
					<input type="submit" value="Edit" name="submit-rsd">
				<?php endforeach ?>
			<?php endif ?>
					<p id="error-text"><?php echo $errorRsd ?? '' ?></p>
					<p id="error-text"><?php echo $msgRsd ?? '' ?></p>
					<p id="success-text"><?php echo $successRsd ?? '' ?></p>

		</form>
	


	</div>
	<?php include'./inc/footer.php' ?>
</body>
</html>