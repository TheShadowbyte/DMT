<?php
	
	require_once("layout/header.php");
	
	class Home { 

		public function __construct() {
			echo "home page";	
		}

		// This method is meant to link to an admin backend module
		public function latestNews() {

		}

	}

	$home = new Home();

	require_once("layout/footer.php");

?>