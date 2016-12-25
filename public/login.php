<?php

	require_once("includes/session.php");
	
	class LoginView {

		public function __construct() {
			$this->session = $_SESSION['session_data'];
			if (isset($this->session->username)) {
				$this->session->redirect("/");
			}
			else {
				$this->loginPage();
			}
		}

		// The full login page
		private function loginPage() {
			require_once("layout/header.php");
			$this->loginForm();
			require_once("layout/footer.php");
		}

		// The HTML login form
		private function loginForm() {
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

	}

	$login = new LoginView();

?>