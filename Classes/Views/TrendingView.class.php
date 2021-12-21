<?php
namespace Classes\Views;

use  Classes\Models as Models;

class TrendingView extends Models\Trending{
	public function get() {
		$data = $this->getAllData();

		return $data;
	}

	public function getId(){
		$data = $this->getSingleId();

		return $data;
	}
}