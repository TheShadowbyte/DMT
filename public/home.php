<?php
	
	class Home { 

		public function __construct() {
			require_once("layout/header.php");
			echo "home page";
			require_once("layout/footer.php");
		}

	}

?>