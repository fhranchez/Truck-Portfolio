<?php
namespace Classes\Views;

use  Classes\Models as Models;

class RsdView extends Models\Rsd{
	public function get() {
		$data = $this->getAllData();

		return $data;
	}

	public function getId(){
		$data = $this->getSingleId();

		return $data;
	}
}