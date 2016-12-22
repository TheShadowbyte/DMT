<?php

	require_once("database.php");

	class User {

		private $username;
		private $email;
		private $password;
		private $passwordConfirm;
		public  $postType;

		function __construct() {
			$this->username = $_POST['username'];
			$this->email = $_POST['email'];
			$this->password = $_POST['password'];
			$this->passwordConfirm = $_POST['password-confirm'];
			$this->postType = $_POST['post-type'];
			$this->database = new Database();
		}

		// Perform user registration
		public function register() {
			if ($this->registerCheckExistingUsername() == false) {
				$sql = "INSERT INTO users (username, password, email, user_type) VALUES ('$this->username', '$this->password', '$this->email', 'registered')";
				return $this->database->query($sql);
			}
			else {
				// Don't register if username exists
				// In the future create 'user already exists' notification to client.
				return false;
			}
		}

		// Returns true if username already exists
		private function registerCheckExistingUsername() {
			$sql = "SELECT * FROM users WHERE username='$this->username' LIMIT 1";
			if (mysqli_num_rows($this->database->query($sql)) > 0) {
				return true;
			}
			else {
				return false;
			}
		}

	}

	$user = new User();
	if ($user->postType == "register") {
		$user->register();
	}

?>