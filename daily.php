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
//---------------------------------------------------------------

date_default_timezone_set("Asia/Seoul");
$year=date('Y');
$full_day=date('Y-m-d');

if (isset($_GET['month']) && isset($_GET['day'])) {
	$full_day=date("{$year}-{$_GET['month']}-{$_GET['day']}");
}
//------------------------------------------------------------------
$month=date('m');
$day=date('d');

if (isset($_GET['month']) && isset($_GET['day'])) {
	$plus_button="<a id='create_todo' href=\"create_todo_page.php?month={$_GET['month']}&day={$_GET['day']}\">+</a>";
}
else {
	$plus_button="<a id='create_todo' href=\"create_todo_page.php?month={$month}&day={$day}\">+</a>";
}

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Daily Plan</title>
	<link rel='stylesheet' href='index.css'>
	<script type='text/JavaScript' src='index.js'></script>
</head>
<body>
	<header>
		<h1 id='title'>Daily Plan</h1>
		<div id='main_menu'>
			<nav><?=$nav_list?></nav>
		</div>
	</header>

	<h2><?=$full_day?></h2>
	
	<div id='create_button'>
		<?=$plus_button?>
	</div>
	
	<div id='day_plan'>	
		<p></p>	
	</div>
</body>
</html>