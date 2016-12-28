<?php

	require_once("/../includes/session.php");
	require_once("includes/class.user-edit.php");
	require_once("includes/class.user-edit-view.php");

	class AdminUserEditController {

		public function __construct() {
			$this->session = $_SESSION['session_data'];
			if (isset($this->session->username)) {
				if (isset($_POST['post-type'])) {
					new AdminUserEdit();
				}
				else {
					new AdminUserEditView();
				}
			}
			else {
				$this->session->redirect("/");
			}
		}

	}

	$adminUserEditController = new AdminUserEditController();

?>