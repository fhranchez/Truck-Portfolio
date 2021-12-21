<?php 
namespace Classes\Controllers;

trait Controller {
	use \Classes\Dbh;
	protected $resultPerPage = 2;
	protected $loginId = ['username' => 'admin', 'password' => 'password'];

	protected function pagination($tbName) {
		$query = $this->connect()->query("SELECT COUNT(*) FROM $tbName");
		$rowCount  = $query->fetchColumn();
		$numOfPages = ceil($rowCount/$this->resultPerPage);

		return $numOfPages;
	}

	protected function cookies() {
		session_start();   
		$alerts = [];

		if (isset($_POST['submitAdmin'])) {

			if ($_POST['username'] === $this->loginId['username'] && $_POST['password'] === $this->loginId['password']) {
				$alerts['success'] = 'Login Successfull';
				$_SESSION['password'] = $this->loginId['password'] ;
				header("location: adminPanel.php");
				die();
			}else{
				$alerts['error'] = "Invalid Username or Password";
			}
		}

		return $alerts;
	}

	protected function loginAuth() {
		$this->cookies();
		$session = $_SESSION['password'] ?? '';
		if (!$session) {
			echo '<script language="javascript">window.location="admin.php";</script>'; 
			die();
		}
	}

	protected function sessionLogout() {
		$this->cookies();
		session_destroy();

		return header('location: index.php');
	}

}