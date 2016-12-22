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
			$this->encryptedPassword = $this->passwordEncrypt();
		}

		// Perform user registration
		public function register() {
			if ($this->usernameExistent() == false && $this->emailExistent() == false) {
				$sql = "INSERT INTO users 
										(
											username,
											password,
											email,
											user_type
										) 
								VALUES (
											'$this->username', 
											'$this->encryptedPassword', 
											'$this->email', 
											'registered'
										)";
				return $this->database->query($sql);
			}
			else {
				return false;
			}
		}

		// Returns true if username already exists
		private function usernameExistent() {
			$sql = "SELECT * FROM users WHERE username='$this->username' LIMIT 1";
			if (mysqli_num_rows($this->database->query($sql)) > 0) {
				return true;
			}
			else {
				return false;
			}
		}

		// Returns true if email address is already in use
		private function emailExistent() {
			$sql = "SELECT * FROM users WHERE email='$this->email' LIMIT 1";
			if (mysqli_num_rows($this->database->query($sql)) > 0) {
				return true;
			}
			else {
				return false;
			}
		}

		// Encrypts password using Blowfish
		private function passwordEncrypt() {
			if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        		$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
        		return crypt($this->password, $salt);
    		}
		}

	}

	$user = new User();
	if ($user->postType == "register") {
		$user->register();
	}

?>