<?php
	
	require_once("layout/header.php");
	
	class Home { 

		public function __construct() {
			echo "home page";	
		}

	}

	$home = new Home();

	require_once("layout/footer.php");

?>