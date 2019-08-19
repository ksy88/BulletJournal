<?php 
include("nav.php");
//---------------------------------------------------------------

date_default_timezone_set("Asia/Seoul");
$year=date('Y');
$full_day=date('Y-m-d');
if (isset($_GET['year'])&&isset($_GET['month']) && isset($_GET['day'])) {
	$full_day=date("{$_GET['year']}-{$_GET['month']}-{$_GET['day']}");
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
		<a id='create_todo' href="create_todo_page.php">+</a>
	</div>
	
	<div id='day_plan'>	
			<form action='process_todo.php' method="post">
				Title of Todo : <br>
					<input id='todo_title' type='text' name='todo_title' placeholder="What do you wanna do?"> <br>
				Starts From : <br>
					<input class='todo_time' type='time' name='todo_start_time'> <br>
				Ends In : <br>
					<input class='todo_time' type='time' name='todo_end_time'> <br>
				Description about the Task : <br>
					<textarea id='description' name='description' placeholder="write here!"></textarea> <br>
				<div id='add_todo_button'>	
					<input type='submit' value='Add Todo-list'>
				</div>
			</form>	
	</div>
</body>
</html>