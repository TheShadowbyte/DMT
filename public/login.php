<?php
	
	class Login { 

		public function __construct() {
			require_once("layout/header.php");
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
			require_once("layout/footer.php");
		}

	}

?>