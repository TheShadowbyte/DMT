<?php

	require_once("/../includes/database.php");
	require_once("/../includes/session.php");
	require_once("/../includes/user.php");
	require_once("includes/class-login-admin.php");

	// This class is a model for the admin backend
	class Admin {

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
			echo "<h1>Edit News</h1>";
			$this->editNews();
			require_once("layout/admin-footer.php");
		}

		// This loops through all the news in order to edit them.
		// Future revision will allow each post to be on its own page.
		private function editNews() {
			$sql = "SELECT * FROM news";
			$query = $this->user->database->query($sql);
			while ($newsArray = mysqli_fetch_assoc($query)) {
				?>
				<input id="post-title" type="text" name="post-title" value="<?php echo $newsArray["title"]; ?>" /><br /><br />
				<textarea id="post-content" name="post-content" rows="4" cols="40"><?php echo $newsArray["content"]; ?></textarea><br /><br />
				<input id="update-post-<?php echo $newsArray["id"]; ?>" type="submit" value="Update Post">
				<?php
			}
		}

	}

	$admin = new Admin();

?>