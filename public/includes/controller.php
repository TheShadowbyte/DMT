<?php

	require_once("format.php");

	if (Format::checkPostType("login")) {
		require_once("class-login.php");
		$login = new Login($_POST['username'], $_POST['password']);
	}
	elseif (Format::checkPostType("admin-login")) {
		require_once("../admin/includes/class.login-admin.php");
		$loginAdmin = new LoginAdmin($_POST['username'], $_POST['password']);
	}
	elseif (Format::checkPostType("logout")) {
		require_once("session.php");
		$session = new Session();
	}

?>