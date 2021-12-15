<?php 
namespace Classes\Controllers;

trait Controller {
	use \Classes\Dbh;
	protected $resultPerPage = 2;

	protected function pagination($tbName) {
		$query = $this->connect()->query("SELECT COUNT(*) FROM $tbName");
		$rowCount  = $query->fetchColumn();
		$numOfPages = ceil($rowCount/$this->resultPerPage);

		return $numOfPages;
	}

}