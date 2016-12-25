<?php

	require_once("database.php");
	require_once("format.php");
	require_once("session.php");
	
	class Login {

		public function __construct() {
			$this->session = $_SESSION['session_data'];
			$this->database = new Database();
			// What to do if login is requested.
			if (isset($_POST['post-type']) == "login") {
				$this->username = Format::cleanStrings($this->database->openConnection(), $_POST['username']);
				$this->password = Format::cleanStrings($this->database->openConnection(), $_POST['password']);
				$this->verifyLogin();
			}
			else {
				$this->session->redirect("/");
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
		protected function getPassword($username) {
			$sql = "SELECT password FROM users WHERE username='$username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['password'];
		}

		// User login authentication.
		protected function checkPassword() {
			if (crypt($this->password, $this->getPassword($this->username)) == $this->getPassword($this->username)) {
				return true;
			}
			else {
				return false;
			}
		}

		// Begin session for user.
		protected function loginUser() {
			return $this->session->login($this->username);
		}

	}

?>