<?php
	
	class Login { 

		public function __construct() {
			require_once("layout/header.php");
			?>
			<form action="" method="POST">
			  Username:<br>
			  <input type="text" name="username"><br>
			  Password:<br>
			  <input type="text" name="password">
			  <br>
			  <input type="submit" value="Login">
			</form>
			<?php
			require_once("layout/footer.php");
		}

	}

?>