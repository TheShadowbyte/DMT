<?php
	
	class Register { 

		public function __construct() {
			require_once("layout/header.php");
			?>
			<form id="register">
			  Username:<br>
			  <input type="text" name="username"><br>
			  Password:<br>
			  <input type="text" name="password">
			  <br>
			  <input type="submit" value="Sign up">
			</form>
			<?php
			require_once("layout/footer.php");
		}


	}

?>