<?php 
namespace Classes\Controllers;

use Classes\Models as Models;
use Classes\Controllers as Controllers;

class AvailableContr extends Models\Available {
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

	public function cookiesFunc() {
		$msg = $this->cookies();
	
	return $msg;
	}

	public function auth() {
		$this->loginAuth();
	}

	public function logout() {
		$this->sessionLogout();
	}

	public function logoutBtn() {
		 if (!empty($_SESSION['password'])) {
			echo '<div class="align-btn">
				<a class="logout" href="logout.php">Logout</a>
		</div>';
		}
	}
}