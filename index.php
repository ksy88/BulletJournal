<?php 
include("nav.php");
include("main_login.php");
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome to Your Bullet Journal!</title>
	<link rel='stylesheet' href='index.css'>
	<script type='text/JavaScript' src='index.js'></script>
</head>
<body style="
	background-image: url('index_img.jpg');
	background-repeat:no-repeat;
	background-size:cover;
	height: 500px;
	">
	<header style="vertical-align: top;">
		<h1 id='title'>Welcome to Your Bullet Journal!</h1>
		<div id='main_menu'>
			<nav><?=$nav_list?></nav>
		</div>
	</header>
	<div id=login_info_wrap><div id=login_info><?=$print_login_info?></div></div>
</body>
</html>