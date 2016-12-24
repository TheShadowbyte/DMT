<?php

	require_once("includes/database.php");
	require_once("includes/session.php");
	require_once("layout/header.php");
	
	class Login {

		public function __construct() {
			if (isset($_POST['post-type'])) { $this->postType = $_POST['post-type']; }
			if (isset($_POST['username'])) { $this->username = $_POST['username']; }
			if (isset($_POST['password'])) { $this->password = $_POST['password']; }
			$this->loginForm();
			$this->database = new Database();
		}

		public function loginForm() {
			?>
			<form id="login">
			  Username:<br>
			  <input id="username" type="text" name="username"><br>
			  Password:<br>
			  <input id="password" type="password" name="password"><br>
			  <br>
			  <input id="login-submit" type="submit" value="Login">
			</form>
			<?php
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
		public function loginUser() {
			global $session;
			return $session->login($this->username);
		}

	}

	$login = new Login();

	require_once("layout/footer.php");

?>