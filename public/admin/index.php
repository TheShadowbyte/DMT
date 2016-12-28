<?php

	require_once("/../includes/database.php");
	require_once("/../includes/session.php");
	require_once("/../includes/user.php");
	require_once("includes/class.login-admin.php");

	// This class is a view for the admin backend
	class AdminView {

		public function __construct() {
			$this->session = $_SESSION['session_data'];
			$this->user = $_SESSION['user_data'];
			$this->userType = $this->user->getUserType();
			if ($this->session->isLoggedIn()) {
				if ($this->userType == "administrator") {
					$this->adminStructure();
				}
				else {
					$this->session->redirect("/");
				}
			}
			else {
				require_once("includes/login-admin.php");
			}
		}

		// Builds the logged in admin page.
		private function adminStructure() {
			require_once("layout/admin-header.php");
			echo "Logged in as " . $this->session->username . "<br />";
			?>
			<a href="news.php">News</a>
			<a href="users.php">Users</a>
			<?php
			require_once("layout/admin-footer.php");
		}

	}

	$admin = new AdminView();

?>