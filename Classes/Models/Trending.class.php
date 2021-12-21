<?php  
namespace Classes\Models;

use Classes\Models as Models;

class Trending{
	use Models\Model;

	protected $tbName = 'trending';

	protected function createAllData() {
		$msgs = $this->createAllDataQry(
				$_POST['submitTrn'] ?? null,
				$_POST['desTrn'] ?? '',
				$_POST['phoneTrn'] ?? '',
				$_POST['priceTrn'] ?? '',
				$_FILES['imgTrn']['name'] ?? '',
				$_POST['imgTextTrn'] ?? '',
				$_FILES['imgTrn']['tmp_name'] ?? null,
				$this->tbName
				);
		
		return $msgs;

	}

	protected function getAllData() {
		$data = $this->getAllDataQry($_GET['page-trn'] ?? null,$this->tbName);	

		return $data;
	}

	protected function getSingleId() {
		$data = $this->getSingleIdQry($_GET['trn-id'] ?? null, $this->tbName);

		return $data;
	}

	protected function updateData(){
		$msgs = $this->updateDataQry(
			$_POST['submit-trn'] ?? null,
			$_GET['trn-id'] ?? null,
			$_POST['description-trn'] ?? '',
			$_POST['price-trn'] ?? '',
			$_POST['phone-trn'] ?? '',
			$_FILES['imgTrn']['name'] ?? '',
			$_FILES['imgTrn']['tmp_name'] ?? null,
			$this->tbName
		);

		return $msgs;
	}

	protected function deleteSingleId() {
		$this->deleteSingleIdQry(
			$_POST['deleteTrn'] ?? null,
			$_POST['id_to_deleteTrn'] ?? '',
			$this->tbName);
	}
}



