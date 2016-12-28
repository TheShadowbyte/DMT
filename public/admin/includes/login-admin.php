<?php

	require_once("/../../includes/database.php");
	require_once("/../../includes/session.php");
	require_once("class.login-admin.php");
	
	class LoginAdminView {

		public function __construct() {
			// Note to self: check if a login session already exists from front-end
			// and whether that session contains an admin user.
			$this->session = $_SESSION['session_data'];
			if (!$this->session->isLoggedIn()) {
				require_once("/../layout/admin-header.php");
				echo "<h2>Admin Login</h2>";
				$this->adminLoginForm();
				require_once("/../layout/admin-footer.php");
			}
		}

		// Note to self: make Layout and AdminLayout classes
		private function adminLoginForm() {
			?>
			<form id="login">
			  Username:<br>
			  <input id="username" type="text" name="username"><br>
			  Password:<br>
			  <input id="password" type="password" name="password"><br>
			  <br>
			  <input id="admin-login-submit" type="submit" value="Login">
			</form>
			<?php
		}

	}

	$adminLoginView = new LoginAdminView();

?>