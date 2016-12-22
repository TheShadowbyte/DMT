<?php

	require_once("../includes/database.php");

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordConfirm = $_POST['password-confirm'];

	$sql = "INSERT INTO users (username, password, email, user_type) VALUES ('$username', '$password', '$email', 'registered')";
	$database = new Database();
	$database->query($sql);
	
?>