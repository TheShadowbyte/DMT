<?php
	
	class Login {

		public function __construct() {
			require_once("layout/header.php");
			if (!$session->isLoggedIn()) {
				$this->loginForm();
			}
			else {
				$session->redirect("/");
			}
			require_once("layout/footer.php");
			$this->session = $session;
		}

		public function loginForm() {
			?>
			<form id="login">
			  Username:<br>
			  <input id="username" type="text" name="username"><br>
			  Password:<br>
			  <input id="password" type="password" name="password">
			  <br>
			  <input id="login-submit" type="submit" value="Login">
			</form>
			<?php
		}

		public function loggedIn() {
			
		}

	}

?>