<?php

	class NotFound { 

		public function __construct() {
			require_once("layout/header.php");
			echo "404 page not found";
			require_once("layout/footer.php");
		}

	}
	
?>