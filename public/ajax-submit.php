<?php

	$database = new Database();

	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordConfirm = $_POST['passwordConfirm'];

	$sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
	$database->query($sql);
	
?>