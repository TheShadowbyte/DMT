<?php

	require_once("includes/database.php");
	require_once("includes/session.php");
	
	class Login {

		public function __construct() {
			$this->session = $_SESSION['session_data'];
			$this->database = new Database();
			// What to do if AJAX requesting login
			if (isset($_POST['post-type']) == "login") {
				if (isset($_POST['username'])) { 
					$this->username = mysqli_real_escape_string($this->database->openConnection(), $_POST['username']); 
				}
				if (isset($_POST['password'])) { 
					$this->password = mysqli_real_escape_string($this->database->openConnection(), $_POST['password']);
				}
				$this->verifyLogin();
			}
			// What to do during normal page view
			else {
				// Note to self: check if username is a real user, as well as authenticated
				if (isset($this->session->username)) {
					$this->session->redirect("/");
				}
				else {
					$this->loginPage();
				}
			}
		}

		public function loginPage() {
			require_once("layout/header.php");
			$this->loginForm();
			require_once("layout/footer.php");
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
		private function getPassword($username) {
			$sql = "SELECT password FROM users WHERE username='$username' LIMIT 1";
			return mysqli_fetch_assoc($this->database->query($sql))['password'];
		}

		// User login authentication
		public function checkPassword() {
			if (crypt($this->password, $this->getPassword($this->username)) == $this->getPassword($this->username)) {
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

?>