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
			$this->postType = $_POST['post-type'];
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

		// User login authentication
		public function login() {
			return crypt($this->password, $this->getPassword()) == $this->getPassword();
		}

		// Get the hashed password from the database to compare with login attempt
		private function getPassword() {
			$sql = "SELECT password FROM users WHERE username='$this->username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['password'];
		}

		// Begin session for user
		public function startSession() {
			return $this->session->login($this->username);
		}

	}

	$user = new User($session);
	if ($user->postType == "register") {
		$user->register();
	}
	elseif ($user->postType == "login") {
		if ($user->login() == 1) {
			$user->startSession();
			echo "success";
		}
		else {
			echo "failure";
		}
	}
	elseif ($user->postType == "logout") {
		$session->logout();
		echo "success";
	}

?>