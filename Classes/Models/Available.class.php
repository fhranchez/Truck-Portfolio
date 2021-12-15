<?php  
namespace Classes\Models;

use  Classes\Models as Models;

class Available{
	use Models\Model;

	protected $tbName = 'available';

	protected function createAllData() {
		$msgs = $this->createAllDataQry(
				$_POST['submitAva'] ?? null,
				$_POST['desAva'] ?? '',
				$_POST['phoneAva'] ?? '',
				$_POST['priceAva'] ?? '',
				$_FILES['imgAva']['name'] ?? '',
				$_POST['imgTextAva'] ?? '',
				$this->tbName
				);
		
		return $msgs;

	}

	protected function getAllData() {
		$data = $this->getAllDataQry($_GET['page-ava'] ?? null,$this->tbName);	

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





