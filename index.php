<?php 
$nav_array= array('home', 'monthly', 'weekly', 'daily');
$nav_list='';
$i=0;
while($i<count($nav_array)) {
	if($nav_array[$i]!='home'){
		$nav_list=$nav_list."<a href=\"{$nav_array[$i]}.php\">{$nav_array[$i]}</a>";
		$i=$i+1;
	}
	else {
		$nav_list=$nav_list."<a href=\"index.php\">{$nav_array[$i]}</a>";
		$i=$i+1;
	}
}
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
	">
	<header>
		<h1 id='title'>Welcome to Your Bullet Journal!</h1>
		<div id='main_menu'>
			<nav><?=$nav_list?></nav>
		</div>
	</header>
</body>
</html>