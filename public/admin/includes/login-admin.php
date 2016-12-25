<?php

	class LoginAdmin {

		public function __construct() {
			// Note to self: check if a login session already exists from front-end
			echo "<h2>Admin Login</h2>";
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

	$adminLogin = new LoginAdmin();

?>