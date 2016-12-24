<?php

	require_once("route.php");
	require_once("home.php");
	require_once("login.php");
	require_once("register.php");
	require_once("profile.php");
	require_once("404.php");

	$route = new Route();

	$route->add("/", "Home");
	$route->add("/login", "Login");
	$route->add("/register", "Register");
	$route->add("/profile", "Profile");

	$route->submit();

?>