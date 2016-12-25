<?php

	require_once("database.php");
	require_once("session.php");

	class User {

		private $username;
		private $email;

		function __construct() {
			$this->session = $_SESSION['session_data'];
			$this->username = $this->session->username;
			$this->database = new Database();
			if (isset($_POST['post-type']) == "change-email") {
				if (isset($_POST['email'])) {
					$this->email = $_POST['email'];
				}
				if ($this->changeEmail()) {
					echo "success";
				}
				else {
					echo "failure";
				}
			}
		}

		public function getUsername() {
			$sql = "SELECT username FROM users WHERE username='$this->username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['username'];
		}

		// Fetch the current user email
		public function getEmail() {
			$sql = "SELECT email FROM users WHERE username='$this->username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['email'];
		}

		// Change the user email
		public function changeEmail() {
			if ($this->checkExistingEmail() == false) {
				$sql = "UPDATE users SET email='$this->email' WHERE user='$this->username'";
				$this->database->query($sql);
				return true;
			}
			else {
				return false;
			}
		}

		// Check if new email is already in use
		private function checkExistingEmail() {
			$sql = "SELECT * FROM users WHERE email='$this->email'";
			$query = $this->database->query($sql);
			if (mysqli_num_rows($query) > 0) {
				return true;
			}
			else {
				return false;
			}
		}

	}

	$user = new User();
	$_SESSION['user_data'] = $user;

?>