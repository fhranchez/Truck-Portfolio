<?php 
namespace Classes\Controllers;

use  Classes\Models as Models;

class AvailableContr extends Models\Available {
	public function createAllData() {
		$msgs = $this->createAllDataQry();

		return $msgs;
	}

	public function updateData() {
		$msgs = $this->updateDataQry();

		return $msgs;
	}

	public function deleteSingleId() {
		$this->deleteSingleIdQry();
	}

	public function pagination($tbName) {
		$query = $this->connect()->query("SELECT COUNT(*) FROM $tbName");
		$rowCount  = $query->fetchColumn();
		$numOfPages = ceil($rowCount/$this->resultPerPage);

		return $numOfPages;
	}
}