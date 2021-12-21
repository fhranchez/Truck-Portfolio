<?php
namespace Classes\Models;

trait Model{
	use \Classes\Dbh;

	protected $resultPerPage = 2;

	protected function createAllDataQry($submit,$description,$phone,$price,$image,$imgText,$imgTmp,$tbName) {
		$msgs = [];
		if (isset($submit)) {
			$des = trim($description);
			$ph = trim($phone);
			$pri = trim($price);
			$img = $image;
			$imgT = trim($imgText);
			$target = "img/". basename($image);

			// form validation
			if (empty($des) || empty($pri) || empty($img) || empty($ph) || empty($imgT)) {
				$msgs['error'] = '*All fields are required*';
			}else{
				$sql = "INSERT INTO $tbName(image, img_dir, description, price, phone) VALUES(:img, :img_text, :des, :price, :phone)";
				$stmt = $this->connect()->prepare($sql);
				$stmt->execute(['img' => $img, 'img_text' => $imgT, 'des' => $des, 'price' => $pri, 'phone' => $ph]);

				if (move_uploaded_file($imgTmp, $target)) {
			  		$msgs['img_msg_success'] = "Image uploaded successfully";
			  	}else{
			  		$msgs['img_msg_error'] = "Failed to upload image";
			  	}
		  		$msgs['congrats'] =  'File uploaded successfully';
		   }
		 }
		
		return $msgs;
	}

	protected function getAllDataQry($pageId,$tbName){
		// Get All data with pagination
		if (!isset($pageId)) {
			$page = 1;
		}else{
			$page = $pageId;
		}

		$offset =  ($page-1)*$this->resultPerPage; 
		$sql = "SELECT * FROM $tbName ORDER BY id desc LIMIT $offset,$this->resultPerPage";
		$data = $this->connect()->query($sql);

		return $data;
	}

	protected function getSingleIdQry($pageId,$tbName) {
		if (isset($pageId)) {
			$id = $pageId;
			$sql = "SELECT * FROM $tbName WHERE id =:id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['id' => $id]);
			$data = $stmt->fetchAll();

			return $data;
		}
	}

		protected function updateDataQry($submitId,$getId,$description,$price,$phone,$image,$imgTmp,$tbName) {
		$msgs = [];
		if (isset($submitId)) {
			$id = $getId;
			$des = trim($description);
			$pri = trim($price);
			$ph = trim($phone);
		 	$imgPath = "img/". basename($image);


		//form validation
	 	if (empty($des) || empty($pri) || empty($ph) || empty($image)) {
	 		$msgs['error'] = '*All fields are required*';
	 	}else {
	 		$sql = "UPDATE $tbName SET description = :des, price = :price, image = :image, phone = :phone WHERE id = :id";
	 		$stmt = $this->connect()->prepare($sql); 
	 		$stmt->execute(['des' => $des, 'price' => $pri, 'image' => $image, 'phone' => $ph, 'id' => $id]);

	 		if (!move_uploaded_file($imgTmp, $imgPath)) {
		  		$msgs['img_msg'] = "Failed to upload image";
		  	}
		  	$msgs['success'] = 'file updated successfully';
	 	 }
		}

		return $msgs;
	}

	protected function deleteSingleIdQry($submitId,$id,$tbName) {
		if (isset($submitId)) {
			$sql = "DELETE FROM $tbName WHERE id = :id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute(['id' => $id]);
		}
	}


}