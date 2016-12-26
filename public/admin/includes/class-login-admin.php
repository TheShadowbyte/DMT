<?php

	require_once("/../../includes/database.php");
	require_once("/../../includes/format.php");
	require_once("/../../includes/session.php");
	require_once("/../../includes/class-login.php");
	
	class LoginAdmin extends Login {

		public function __construct() {
			$this->login = new Login();
			if (Format::checkPostType("admin-login")) {
				if ($this->isAdmin($this->login->username)) {
					$this->login->verifyLogin();
				}
				else {
					echo "You are not an administrator";
				}
			}
		}

		// Check if user is an administrator for admin login.
		private function isAdmin($username) {
			$sql = "SELECT user_type FROM users WHERE username='$username' LIMIT 1";
			$userType = mysqli_fetch_assoc($this->login->database->query($sql))['user_type'];
			if ($userType == "administrator") {
				return true;
			}
		}

	}

?>