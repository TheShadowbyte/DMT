<?php

	require_once("database.php");
	require_once("format.php");
	require_once("session.php");
	
	class Login {

		protected $username;
		protected $database;

		public function __construct($username, $password) {
			$this->session = $_SESSION['session_data'];
			$this->database = new Database();
			if (Format::checkPostType("login") || Format::checkPostType("admin-login")) {
				$this->username = Format::cleanStrings($this->database->openConnection(), $username);
				$this->password = Format::cleanStrings($this->database->openConnection(), $password);
				if (Format::checkPostType("login")) {
					$this->verifyLogin();
				}
			}
		}

		// Perform a login verification and respond to client.
		protected function verifyLogin() {
			if ($this->checkPassword() == true) {
				$this->loginUser();
				echo "success";
			}
			else {
				echo "failure";
			}
		}

		// Get the hashed password from the database to compare with login attempt.
		private function getPassword($username) {
			$sql = "SELECT password FROM users WHERE username='$username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['password'];
		}

		// User login authentication.
		private function checkPassword() {
			if (crypt($this->password, $this->getPassword($this->username)) == $this->getPassword($this->username)) {
				return true;
			}
			else {
				return false;
			}
		}

		// Begin session for user.
		private function loginUser() {
			return $this->session->login($this->username);
		}

	}

?>