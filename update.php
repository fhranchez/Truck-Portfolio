<?php
include_once('inc/autoloader.inc.php');

use Classes\Controllers\AvailableContr;
use Classes\Views\AvailableView;

use Classes\Controllers\TrendingContr;
use Classes\Views\TrendingView;

use Classes\Controllers\RsdContr;
use Classes\Views\RsdView;


// AVAILABLE
$avaView = new AvailableView();
$avaContr = new AvailableContr();

// Login Authentication
$avaContr->auth();

//Getting data
$result = $avaView->getId();


//Updating Data
$msgs = $avaContr->update();



//TRENDING
$trnView = new TrendingView();
//Getting data
$resultTrn = $trnView->getId();

// Updating data
$objTrn = new TrendingContr();
$msgsTrn = $objTrn->update();



//RECENTLY SOLD
$rsdView = new RsdView();
//Getting data
$resultRsd = $rsdView->getId();

// Updating data
$objRsd = new RsdContr();
$msgsRsd = $objRsd->update();

 
?>

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
					<p id="error-text"><?php echo $msgs['error'] ?? '' ?></p>
					<p id="error-text"><?php echo $msgs['img_msg'] ?? '' ?></p>
					<p id="success-text"><?php echo $msgs['success'] ?? '' ?></p>

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
					<p id="error-text"><?php echo $msgsTrn['error'] ?? '' ?></p>
					<p id="error-text"><?php echo $msgsTrn['img_msg'] ?? '' ?></p>
					<p id="success-text"><?php echo $msgsTrn['success'] ?? '' ?></p>


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
					<p id="error-text"><?php echo $msgsRsd['error'] ?? '' ?></p>
					<p id="error-text"><?php echo $msgsRsd['img_msg'] ?? '' ?></p>
					<p id="success-text"><?php echo $msgsRsd['success'] ?? '' ?></p>


		</form>
	


	</div>
	<?php include'./inc/footer.php' ?>
</body>
</html>