<?php
	
	class Register { 

		public function __construct() {
			require_once("layout/header.php");
			?>
			<form id="register">
			  Username<br>
			  <input type="text" name="username"><br>
			  Email<br>
			  <input type="text" name="email"><br>
			  Password<br>
			  <input type="password" name="password"><br>
			   Confirm Password<br>
			  <input type="password" name="confirm-password"><br>
			  <br>
			  <input id="register-submit" type="submit" value="Sign Up">
			</form>
			<?php
			require_once("layout/footer.php");
		}

	}

?>