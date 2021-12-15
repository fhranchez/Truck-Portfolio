<?php  
namespace Classes\Models;

// class Trending extends \Classes\Dbh{

// 	protected $resultPerPage = 2;

// 	protected function createAllDataQry() {
// 		$msgs = [];
// 		if (isset($_POST['submitTrn'])) {
// 			$des = trim($_POST['desTrn']);
// 			$price = trim($_POST['priceTrn']);
// 			$phone = trim($_POST['phoneTrn']);
// 			$image = $_FILES['imgTrn']['name'];
// 			$img_text = trim($_POST['imgTextTrn']);
// 			$target = "img/". basename($image);

// 		// form validation
// 		if (empty($des) || empty($price) || empty($image) || empty($phone) || empty($img_text)) {
// 			$msgs['error'] = '*All fields are required*';
// 		}else{

// 		$sql = "INSERT INTO trending(image, img_dir, description, price, phone) VALUES(:img, :img_text, :des, :price, :phone)";
// 		$stmt = $this->connect()->prepare($sql);
// 		$stmt->execute(['img' => $image, 'img_text' => $img_text, 'des' => $des, 'price' => $price, 'phone' => $phone]);

// 		if (move_uploaded_file($_FILES['imgTrn']['tmp_name'], $target)) {
// 	  		$msgs['img_msg'] = "Image uploaded successfully";
// 	  	}else{
// 	  		$msgs['img_msg'] = "Failed to upload image";
// 	  	}
// 	  		$msgs['success'] =  'File uploaded successfully';
// 	   }
// 	 }
		
// 		return $msgs;
// 	}

// 	protected function getAllDataQry(){
// 		// Get All data with pagination
// 		if (!isset($_GET['page-ava'])) {
// 			$pageAva = 1;
// 		}else{
// 			$pageAva = $_GET['page-ava'];
// 		}

// 		$offset =  ($pageAva-1)*$this->resultPerPage; 
// 		$sql = "SELECT * FROM available ORDER BY id desc LIMIT $offset,$this->resultPerPage";
// 		$stmt = $this->connect()->query($sql);

// 		return $stmt;
// 	}

// 	protected function getSingleIdQry() {
// 		if (isset($_GET['ava-id'])) {
// 			$id = $_GET['ava-id'];
// 			$sql = "SELECT * FROM available WHERE id =:id";
// 			$stmt = $this->connect()->prepare($sql);
// 			$stmt->execute(['id' => $id]);
// 			$data = $stmt->fetchAll();

// 			return $data;
// }
// 	}

// 	protected function updateDataQry() {
// 		$msgs = [];
// 		if (isset($_POST['submit'])) {
// 			$id = $_GET['ava-id'] ?? '';
// 			$des = trim($_POST['description'] ?? '');
// 			$price = trim($_POST['price'] ?? '');
// 			$phone = trim($_POST['phone'] ?? '');
// 			$image = $_FILES['imgAva']['name'] ?? '';
// 		 	$imgPath = "img/". basename($image);


// 		//form validation
// 	 	if (empty($des) || empty($price) || empty($phone) || empty($image)) {
// 	 		$msgs['error'] = '*All fields are required*';
// 	 	}else {
// 	 		$sql = "UPDATE available SET description = :des, price = :price, image = :image, phone = :phone WHERE id = :id";
// 	 		$stmt = $this->connect()->prepare($sql); 
// 	 		$stmt->execute(['des' => $des, 'price' => $price, 'image' => $image, 'phone' => $phone, 'id' => $id]);

// 	 		if (!move_uploaded_file($_FILES['imgAva']['tmp_name'], $imgPath)) {
// 		  		$msgs['img_msg'] = "Failed to upload image";
// 		  	}
// 		  	$msgs['success'] = 'file updated successfully';
// 	 	 }
// 		}

// 		return $msgs;
// 	}

// 	protected function deleteSingleIdQry() {
// 		if (isset($_POST['deleteAva'])) {
// 			$id = $_POST['id_to_deleteAva'];
// 			$sql = "DELETE FROM available WHERE id = :id";
// 			$stmt = $this->connect()->prepare($sql);
// 			$stmt->execute(['id' => $id]);
// 		}
// 	}

// }

class Available extends Models\Model{
	protected $tbName = 'trending';

	protected function createAllData() {
		$msgs = $this->createAllDataQry(
				$_POST['submitTrn'] ?? null,
				$_POST['desTrn'] ?? '',
				$_POST['phoneTrn'] ?? '',
				$_POST['priceTrn'] ?? '',
				$_FILES['imgTrn']['name'] ?? '',
				$_POST['imgTextTrn'] ?? '',
				$this->tbName
				);
		
		return $msgs;

	}

	protected function getAllData() {
		$data = $this->getAllDataQry($_GET['ava-id'] ?? null,$this->tbName);	

		return $data;
	}

	protected function getSingleId() {
		$data = $this->getSingleIdQry($_GET['ava-id'] ?? null, $this->tbName);

		return $data;
	}

	protected function updateData(){
		$msgs = $this->updateDataQry(
			$_POST['submit'] ?? null,
			$_GET['ava-id'] ?? null,
			$_POST['description'] ?? '',
			$_POST['price'] ?? '',
			$_POST['phone'] ?? '',
			$_FILES['imgAva']['name'] ?? '',
			$_FILES['imgAva']['tmp_name'] ?? null,
			$this->tbName
		);

		return $msgs;
	}

	protected function deleteSingleId() {
		$this->deleteSingleIdQry(
			$_POST['deleteAva'] ?? null,
			$_POST['id_to_deleteAva'] ?? '',
			$this->tbName);
	}
}



