<?php

	require_once("user.php");

	// Maybe bring below contents back to user.php

	if ($user->postType == "register") {
		$user->register();
	}
	elseif ($user->postType == "login") {
		if ($user->login() == 1) {
			$user->startSession();
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