<?php
namespace Classes\Views;

use  Classes\Models as Models;

class AvailableView extends Models\Available{
	public function get() {
		$data = $this->getAllData();

		return $data;
	}

	public function getId(){
		$data = $this->getSingleId();

		return $data;
	}
}