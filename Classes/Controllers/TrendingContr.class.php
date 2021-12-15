<?php 
namespace Classes\Controllers;

use  Classes\Models as Models;

class TrendingContr extends Models\Trending {
	public function create() {
		$msgs = $this->createAllDataQry();

		return $msgs;
	}

	public function update() {
		$msgs = $this->updateDataQry();

		return $msgs;
	}

	public function delete() {
		$this->deleteSingleIdQry();
	}

	public function pagination() {
		$query = $this->connect()->query("SELECT COUNT(*) FROM $this->tbName");
		$rowCount  = $query->fetchColumn();
		$numOfPages = ceil($rowCount/$this->resultPerPage);

		return $numOfPages;
	}
}