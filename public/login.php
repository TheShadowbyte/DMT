<?php

	require_once("includes/database.php");
	require_once("includes/session.php");
	require_once("layout/header.php");
	
	class Login {

		public function __construct() {
			$this->session = $_SESSION['session_data'];
			$this->database = new Database();
			// What to do if AJAX requesting login
			if (isset($_POST['post-type']) == "login") {
				if (isset($_POST['username'])) { 
					$this->username = $_POST['username']; 
				}
				if (isset($_POST['password'])) { 
					$this->password = $_POST['password']; 
				}
				$this->verifyLogin();
			}
			// What to do during normal page view
			else {
				$this->loginForm();
			}
		}

		// The HTML login form
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

		// Perform a login verification and respond to client
		public function verifyLogin() {
			if ($this->checkPassword() == true) {
				$this->loginUser();
				echo "success";
			}
			else {
				echo "failure";
			}
		}

		// Get the hashed password from the database to compare with login attempt
		private function getPassword() {
			$sql = "SELECT password FROM users WHERE username='$this->username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['password'];
		}

		// User login authentication
		public function checkPassword() {
			if (crypt($this->password, $this->getPassword()) == $this->getPassword()) {
				return true;
			}
			else {
				return false;
			}
		}

		// Begin session for user
		public function loginUser() {
			return $this->session->login($this->username);
		}

	}

	$login = new Login();

	require_once("layout/footer.php");

?>