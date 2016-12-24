<?php
	
	class Profile {

		public function __construct() {
			require_once("layout/header.php");
			if ($session->isLoggedIn()) {
				$this->userProfile();
			}
			else {
				$session->redirect("/");
			}
			require_once("layout/footer.php");
			$this->session = $session;
		}

		public function userProfile() {
			?>
			Welcome
			<?php
		}

	}

?>