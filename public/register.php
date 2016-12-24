<?php

	require_once("includes/database.php");
	require_once("includes/session.php");
	
	class Register { 

		private $username;
		private $email;
		private $password;
		private $passwordConfirm;
		public  $postType;

		public function __construct() {
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
			require_once("layout/header.php");
			$this->registerForm();
			require_once("layout/footer.php");
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

		public function registerUser() {
			
		}

	}

?>