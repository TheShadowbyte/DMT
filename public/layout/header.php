<?php require_once(__DIR__ . "/../includes/session.php"); ?>
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
  			<?php if (!$session->isLoggedIn()) { ?><li><a href="/login">Login</a></li><?php } ?>
        <?php if (!$session->isLoggedIn()) { ?><li><a href="/register">Register</a></li><?php } ?>
        <?php if ($session->isLoggedIn()) { ?><li><a id="profile" href="/profile">Profile</a></li><?php } ?>
        <?php if ($session->isLoggedIn()) { ?><li><a id="logout" href="/">Logout</a></li><?php } ?>
  		</ul>
  	</div>
    <div id="main">