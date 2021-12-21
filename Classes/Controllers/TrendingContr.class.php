<?php 
namespace Classes\Controllers;

use Classes\Models as Models;
use Classes\Controllers as Controllers;

class TrendingContr extends Models\Trending {
	use Controllers\Controller;

	public function create() {
		$msgs = $this->createAllData();

		return $msgs;
	}

	public function update() {
		$msgs = $this->updateData();

		return $msgs;
	}

	public function delete() {
		$this->deleteSingleId();
	}

	public function paginateCount() {
		$data = $this->pagination($this->tbName);

		return $data;
	}
}