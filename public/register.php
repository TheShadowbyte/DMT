<?php

	require_once("includes/database.php");
	require_once("layout/header.php");
	
	class Register { 

		private $username;
		private $email;
		private $password;
		private $passwordConfirm;
		public  $postType;

		public function __construct() {
			$this->database = new Database();
			if (isset($_POST['post-type'])) { 
				$this->postType = mysqli_real_escape_string($this->database->openConnection(), $_POST['post-type']); 
			}
			if (isset($_POST['username'])) { 
				$this->username = mysqli_real_escape_string($this->database->openConnection(), $_POST['username']); 
			}
			if (isset($_POST['email'])) { 
				$this->email = mysqli_real_escape_string($this->database->openConnection(), $_POST['email']); 
			}
			if (isset($_POST['password'])) {
				$this->password = mysqli_real_escape_string($this->database->openConnection(), $_POST['password']);
				if ($this->postType == "register") {
					$this->encryptedPassword = $this->passwordEncrypt();
				}
			}
			$this->registerForm();
		}

		public function registerForm() {
			?>
			<form id="register">
			  Username<br>
			  <input id="username" type="text" name="username"><br>
			  Email<br>
			  <input id="email" type="text" name="email"><br>
			  Password<br>
			  <input id="password" type="password" name="password"><br>
			   Confirm Password<br>
			  <input id="confirm-password" type="password" name="confirm-password"><br>
			  <br>
			  <input id="register-submit" type="submit" value="Sign Up">
			</form>
			<?php
		}

		// Attempt user registration with existence checks
		public function registerUser() {
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

	$register = new Register();

	require_once("layout/footer.php");

	if ($register->postType == "register") {
		$register->registerUser();
	}

?>