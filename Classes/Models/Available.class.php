<?php  
namespace Classes\Models;

class Available extends \Classes\Dbh{

	protected $resultPerPage = 2;

	protected function createAllDataQry() {
		$msgs = [];
		if (isset($_POST['submitAva'])) {
			$desAva = trim($_POST['desAva']);
			$priceAva = trim($_POST['priceAva']);
			$phoneAva = trim($_POST['phoneAva']);
			$imgAva = $_FILES['imgAva']['name'];
			$img_textAva = trim($_POST['imgTextAva']);
			$targetAva = "img/". basename($imgAva);

			// form validation
			if (empty($desAva) || empty($priceAva) || empty($imgAva) || empty($phoneAva) || empty($img_textAva)) {
				$msgs['error'] = '*All fields are required*';
			}else{
				$sql = "INSERT INTO available(image, img_dir, description, price, phone) VALUES(:img, :img_text, :des, :price, :phone)";
				$stmt = $this->connect()->prepare($sql);
				$stmt->execute(['img' => $imgAva, 'img_text' => $img_textAva, 'des' => $desAva, 'price' => $priceAva, 'phone' => $phoneAva]);

				if (move_uploaded_file($_FILES['imgAva']['tmp_name'], $targetAva)) {
			  		$msgs['img_msg'] = "Image uploaded successfully";
			  	}else{
			  		$msgs['img_msg'] = "Failed to upload image";
			  	}
		  		$msgs['congrats'] =  'File uploaded successfully';
		   }
		 }
		
		return $msgs;
	}

	protected function getAllDataQry(){
		// Get All data with pagination
		if (!isset($_GET['page-ava'])) {
			$pageAva = 1;
		}else{
			$pageAva = $_GET['page-ava'];
		}

		$offset =  ($pageAva-1)*$this->resultPerPage; 
		$sql = "SELECT * FROM available ORDER BY id desc LIMIT $offset,$this->resultPerPage";
		$stmt = $this->connect()->query($sql);

		return $stmt;
	}

	protected function getSingleIdQry() {
		if (isset($_GET['ava-id'])) {
			$id = $_GET['ava-id'];
			$sql = "SELECT * FROM available WHERE id =:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['id' => $id]);
			$data = $stmt->fetchAll();

			return $data;
}
	}

	protected function updateDataQry() {
		$msgs = [];
		if (isset($_POST['submit'])) {
			$id = $_GET['ava-id'] ?? '';
			$des = trim($_POST['description'] ?? '');
			$price = trim($_POST['price'] ?? '');
			$phone = trim($_POST['phone'] ?? '');
			$image = $_FILES['imgAva']['name'] ?? '';
		 	$imgPath = "img/". basename($image);


		//form validation
	 	if (empty($des) || empty($price) || empty($phone) || empty($image)) {
	 		$msgs['error'] = '*All fields are required*';
	 	}else {
	 		$sql = "UPDATE available SET description = :des, price = :price, image = :image, phone = :phone WHERE id = :id";
	 		$stmt = $this->connect()->prepare($sql); 
	 		$stmt->execute(['des' => $des, 'price' => $price, 'image' => $image, 'phone' => $phone, 'id' => $id]);

	 		if (!move_uploaded_file($_FILES['imgAva']['tmp_name'], $imgPath)) {
		  		$msgs['img_msg'] = "Failed to upload image";
		  	}
		  	$msgs['success'] = 'file updated successfully';
	 	 }
		}

		return $msgs;
	}

	protected function deleteSingleIdQry() {
		if (isset($_POST['deleteAva'])) {
			$id = $_POST['id_to_deleteAva'];
			$sql = "DELETE FROM available WHERE id = :id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['id' => $id]);
		}
	}

}





