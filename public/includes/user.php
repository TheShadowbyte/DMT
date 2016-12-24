<?php

	require_once("database.php");
	require_once("session.php");

	class User {

		private $username;
		private $email;
		private $password;
		private $passwordConfirm;
		public  $postType;

		function __construct($session) {
			if (isset($_POST['post-type'])) { $this->postType = $_POST['post-type']; }
			if (isset($_POST['username'])) { $this->username = $_POST['username']; }
			if (isset($_POST['email'])) { $this->email = $_POST['email']; }
			if (isset($_POST['password'])) {
				$this->password = $_POST['password'];
				if ($this->postType == "register") {
					$this->encryptedPassword = $this->passwordEncrypt();
				}
			}
			$this->database = new Database();
			$this->session = $session;

		}

		public function getUsername() {
			$sql = "SELECT username FROM users WHERE username='$this->username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['username'];
		}

	}

	$user = new User($session);

?>