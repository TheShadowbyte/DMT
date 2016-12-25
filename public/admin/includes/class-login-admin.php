<?php

	require_once("/../../includes/database.php");
	require_once("/../../includes/format.php");
	require_once("/../../includes/session.php");
	require_once("/../../includes/class-login.php");
	
	class LoginAdmin extends Login {

		public function __construct() {
			$this->session = $_SESSION['session_data'];
			$this->database = new Database();
			// What to do if login is requested.
			if (isset($_POST['post-type']) == "login") {
				$this->login = new Login();
				$this->username = Format::cleanStrings($this->database->openConnection(), $_POST['username']);
				$this->password = Format::cleanStrings($this->database->openConnection(), $_POST['password']);
				$this->login->verifyLogin();
			}
			else {
				// $this->session->redirect("/");
			}
		}

		// Check if user is an administrator for admin login.
		private function isAdmin() {
			$sql = "SELECT user_type FROM users WHERE username='$this->username' LIMIT 1";
			$userType = mysqli_fetch_assoc($this->database->query($sql))['user_type'];
			if ($userType == "administrator") {
				return true;
			}
			else {
				return false;
			}
		}

		// Note to self: make a controller to handle POST subsmissions.

	}

	$loginAdmin = new LoginAdmin();

?>