<?php

	require_once("/../../includes/format.php");
	require_once("/../../includes/class-login.php");
	
	class LoginAdmin extends Login {

		// Perform the usual check from Login, then check if the user is an admin.
		public function __construct($username, $password) {
			parent::__construct($username, $password);
			if (Format::checkPostType("admin-login")) {
				if ($this->isAdmin($this->username)) {
					$this->verifyLogin();
				}
				else {
					echo "You are not an administrator";
				}
			}
		}

		// Check if user is an administrator for admin login.
		private function isAdmin($username) {
			$sql = "SELECT user_type FROM users WHERE username='$username' LIMIT 1";
			$userType = mysqli_fetch_assoc($this->database->query($sql))['user_type'];
			if ($userType == "administrator") {
				return true;
			}
		}

	}

?>