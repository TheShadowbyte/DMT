<?php

	require_once("/../includes/session.php");
	require_once("includes/class.news-edit.php");
	require_once("includes/class.news-edit-view.php");

	class AdminNewsEditController {

		public function __construct() {
			$this->session = $_SESSION['session_data'];
			if (isset($this->session->username)) {
				if (isset($_POST['post-type'])) {
					new AdminNewsEdit();
				}
				else {
					new AdminNewsEditView();
				}
			}
			else {
				$this->session->redirect("/");
			}
		}

	}

	$adminNewsEditController = new AdminNewsEditController();

?>