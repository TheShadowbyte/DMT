<?php
  require_once("/includes/session.php");
  require_once("/login.php");
  if (!$session->isLoggedIn()) {
    // $session->redirect("/login");
  }
  else {
    // $session->redirect("/");
  }
?>
<html>
  <head>
    <title>DMT System</title>
    <link href="assets/css/style.css" media="all" rel="stylesheet" type="text/css" />
    <script src="../assets/js/jquery-3.1.1.js"></script>
    <script src="../assets/js/ajax.js"></script>
  </head>
  <body>
  	<div id="header">
  		<ul id="top-menu">
  			<li><a href="/">Home</a></li>
  			<li><a href="/login">Login</a></li>
        <li><a href="/register">Register</a></li>
        <li><a id="logout" href="/">Logout</a></li>
  		</ul>
  	</div>
    <div id="main">