<?php
session_start();
$sess = $_SESSION['password'] ?? '';
if (!$sess) {
	echo '<script language="javascript">window.location="admin.php";</script>'; die();
}

include('./inc/dbConn.php');
include_once('inc/autoloader.inc.php');


use Classes\Controllers\AvailableContr;
use Classes\Controllers\TrendingContr;



$pdo = new PDO($dsn,$user,$pwd);

$msgRsd = ['success' => '', 'error' => ''];
$errorRsd = '';

$congrats = array('ava' => '', 'trn' => '', 'rsd' => '');

$AvaContr = new AvailableContr();
$msgs = $AvaContr->create();

$trnContr = new TrendingContr();
$msgsTrn = $trnContr->createAllData();



 if (isset($_POST['submitRsd'])) {
	$desRsd = trim($_POST['desRsd']);
	$priceRsd = trim($_POST['priceRsd']);
	$phoneRsd = trim($_POST['phoneRsd']);
	$imgRsd = $_FILES['imgRsd']['name'];
	$img_textRsd = trim($_POST['imgTextRsd']);
	$targetRsd = "img/". basename($imgRsd);

	// form validation
	if (empty($desRsd) || empty($priceRsd) || empty($imgRsd) || empty($phoneRsd) || empty($img_textRsd)) {
		$errorRsd = '*All fields are required*';
	}else{

	$sql = "INSERT INTO recently_created(image, img_dir, description, price, phone) VALUES(:img, :img_text, :des, :price, :phone)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(['img' => $imgRsd, 'img_text' => $img_textRsd, 'des' => $desRsd, 'price' => $priceRsd, 'phone' => $phoneRsd]);

	if (move_uploaded_file($imgRsd, $targetRsd)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  		$congrats['rsd'] =  'File uploaded successfully';
   }
 }

 ?>
 
<?php include'./inc/header.php' ?>

<?php include'./inc/navbar.php' ?>

	<form action="adminPanel.php" class="admin-form" method="POST" enctype="multipart/form-data">
		<div class="panel-form">
			<h2>Available</h2>
			<textarea name="desAva" placeholder="Set Description"><?php echo htmlspecialchars($desAva ?? '') ?></textarea>
			<input type="text" name="priceAva" placeholder="Set Price" value="<?php echo htmlspecialchars($priceAva ?? '') ?>">
			<input type="text" name="phoneAva" placeholder="Set Phone" value="<?php echo htmlspecialchars($phoneAva ?? '08066531931') ?>">
			<input type="hidden" name="size" value="1000000">
			<input type="file" name="imgAva" accept="image/*" value="<?php echo htmlspecialchars($imgAva ?? '') ?>">
			<input type="text" name="imgTextAva" placeholder="Image name.." value="<?php echo htmlspecialchars($img_textAva ?? '') ?>">	
			<input type="submit" name="submitAva" value="Upload">
			<p id="error-text"><?php echo $msgs['error'] ?? '' ?></p>
			<p id="success-text"><?php echo $msgs['congrats'] ?? '' ?></p>
			<p id="success-text"><?php echo $msgs['img_msg'] ?? '' ?></p>

	  	</div>
	  	<div class="panel-form">
	  		<h2>Trending</h2>
			<textarea name="desTrn" placeholder="Set Description"><?php echo htmlspecialchars($desTrn ?? '') ?></textarea>
			<input type="text" name="priceTrn" placeholder="Set Price" value="<?php echo htmlspecialchars($priceTrn ?? '') ?>">
			<input type="text" name="phoneTrn" placeholder="Set Phone" value="<?php echo htmlspecialchars($phoneTrn ?? '') ?>">
			<input type="hidden" name="size" value="1000000">
			<input type="file" name="imgTrn" accept="image/*" value="<?php echo htmlspecialchars($imgTrn ?? '') ?>">
			<input type="text" name="imgTextTrn" placeholder="Image name.." value="<?php echo htmlspecialchars($img_textTrn ?? '') ?>">	
			<input type="submit" name="submitTrn" value="Upload">
			<p id="error-text"><?php echo $msgsTrn['error'] ?? '' ?></p>
			<p id="success-text"><?php echo $msgsTrn['congrats'] ?? '' ?></p>
			<p id="success-text"><?php echo $msgsTrn['img_msg'] ?? '' ?></p>
	  	</div>
	  	<div class="panel-form">
	  		<h2>Recently Sold</h2>
			<textarea name="desRsd" placeholder="Set Description"><?php echo htmlspecialchars($desRsd ?? '') ?></textarea>
			<input type="text" name="priceRsd" placeholder="Set Price" value="<?php echo htmlspecialchars($priceRsd ?? '') ?>">
			<input type="text" name="phoneRsd" placeholder="Set Phone" value="<?php echo htmlspecialchars($phoneRsd ?? '') ?>">
			<input type="hidden" name="size" value="1000000">
			<input type="file" name="imgRsd" accept="image/*" value="<?php echo htmlspecialchars($imgRsd ?? '') ?>">
			<input type="text" name="imgTextRsd" placeholder="Image name.." value="<?php echo htmlspecialchars($img_textRsd ?? '') ?>">	
			<input type="submit" name="submitRsd" value="Upload">
			<p id="error-text"><?php echo $errorRsd ?></p>
			<p id="success-text"><?php echo $congrats['rsd'] ?></p>
			<p id="error-text"><?php echo $msgRsd['error']; ?></p>
			<p id="success-text"><?php echo $msgRsd['success']; ?></p>
	  	</div>
	</form>
			<div class="align-btn">
				<a class="logout" href="logout.php">Logout</a>
			</div>
</div>

<?php include'./inc/footer.php' ?>
</body>
</html>