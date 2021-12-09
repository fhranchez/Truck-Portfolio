<?php
namespace Classes\Views;

use  Classes\Models as Models;

class AvailableView extends Models\Available{
	public function getAllData() {
		$data = $this->getAllDataQry();

		return $data;
	}

	public function getSingleId(){
		$data = $this->getSingleIdQry();

		return $data;
	}
}