<?php
	
	class Register { 

		public function __construct() {
			require_once("layout/header.php");
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
			require_once("layout/footer.php");
		}

	}

?>