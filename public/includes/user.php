<?php

	require_once("database.php");
	require_once("session.php");

	class User {

		public $username;
		private $email;

		function __construct() {
			$this->session = $_SESSION['session_data'];
			if (!empty($this->session->username)) {
				$this->username = $this->session->username;
			}
			$this->database = new Database();
			if (isset($_POST['post-type']) && $_POST['post-type'] == "change-email" && isset($_POST['email'])) {
				$this->email = mysqli_real_escape_string($this->database->openConnection(), $_POST['email']);
				if ($this->changeEmail() == true) {
					echo "success";
				}
				else {
					echo "failure";
				}
			}
		}

		// Fetch the current user's username
		public function getUsername() {
			$sql = "SELECT username FROM users WHERE username='$this->username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['username'];
		}

		// Fetch the current user's email
		public function getEmail() {
			$sql = "SELECT email FROM users WHERE username='$this->username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['email'];
		}

		// Fetch the current user's site role
		public function getUserType() {
			$sql = "SELECT user_type FROM users WHERE username='$this->username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['user_type'];
		}

		// Change the user's email
		public function changeEmail() {
			if ($this->checkExistingEmail() == false) {
				$sql = "UPDATE users SET email='$this->email' WHERE username='$this->username'";
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

		// Encrypts password using Blowfish
		public static function passwordEncrypt($password) {
			if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        		$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        		return crypt($password, $salt);
    		}
		}

	}

	$user = new User();
	$_SESSION['user_data'] = $user;

?>