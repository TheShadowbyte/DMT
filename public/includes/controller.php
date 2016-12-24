<?php

	require_once("../register.php");
	require_once("../login.php");
	require_once("session.php");

	if ($register->postType == "register") {
		$register->registerUser();
	}
	elseif ($login->postType == "login") {
		if ($login->login() == 1) {
			$login->startSession();
			echo "success";
		}
		else {
			echo "failure";
		}
	}
	elseif ($user->postType == "logout") {
		$session->logout();
		echo "success";
	}

?>