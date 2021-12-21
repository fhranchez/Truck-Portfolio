<?php  
namespace Classes\Models;

use Classes\Models as Models;

class Rsd{
	use Models\Model;

	protected $tbName = 'recently_created';

	protected function createAllData() {
		$msgs = $this->createAllDataQry(
				$_POST['submitRsd'] ?? null,
				$_POST['desRsd'] ?? '',
				$_POST['phoneRsd'] ?? '',
				$_POST['priceRsd'] ?? '',
				$_FILES['imgRsd']['name'] ?? '',
				$_POST['imgTextRsd'] ?? '',
				$_FILES['imgRsd']['tmp_name'] ?? null,
				$this->tbName
				);
		
		return $msgs;

	}

	protected function getAllData() {
		$data = $this->getAllDataQry($_GET['page-rsd'] ?? null,$this->tbName);	

		return $data;
	}

	protected function getSingleId() {
		$data = $this->getSingleIdQry($_GET['rsd-id'] ?? null, $this->tbName);

		return $data;
	}

	protected function updateData(){
		$msgs = $this->updateDataQry(
			$_POST['submit-rsd'] ?? null,
			$_GET['rsd-id'] ?? null,
			$_POST['description-rsd'] ?? '',
			$_POST['price-rsd'] ?? '',
			$_POST['phone-rsd'] ?? '',
			$_FILES['imgRsd']['name'] ?? '',
			$_FILES['imgRsd']['tmp_name'] ?? null,
			$this->tbName
		);

		return $msgs;
	}

	protected function deleteSingleId() {
		$this->deleteSingleIdQry(
			$_POST['deleteRsd'] ?? null,
			$_POST['id_to_deleteRsd'] ?? '',
			$this->tbName);
	}
}