<?php

	require_once("format.php");

	if (Format::checkPostType("login")) {
		require_once("class-login.php");
		$login = new Login();
	}
	elseif (Format::checkPostType("admin-login")) {
		require_once("../admin/includes/class-login-admin.php");
		$loginAdmin = new LoginAdmin();
	}

?>