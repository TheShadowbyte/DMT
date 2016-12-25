<?php require_once("/../../includes/session.php"); ?>
<html>
  <head>
    <title>DMT Admin</title>
    <link href="assets/css/admin.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/../../assets/js/jquery-3.1.1.js"></script>
    <script src="/../../assets/js/ajax.js"></script>
  </head>
  <body>
  	<div id="header">
      <ul id="top-menu">
      <?php if (!$_SESSION['session_data']->isLoggedIn()) { ?>
    			<li><a href="/">Back to Home</a></li>
      <?php } else { ?>
          <li><a id="logout" href="/">Logout</a></li>
      <?php } ?>
      </ul>
  	</div>
    <div id="main">