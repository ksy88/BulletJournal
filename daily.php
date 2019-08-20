<?php 
include("nav.php");

//---------------------------------------------------------------

date_default_timezone_set("Asia/Seoul");
$year=date('Y');
$full_day=date('Y-m-d');

if (isset($_GET['year'])&&isset($_GET['month']) && isset($_GET['day'])) {
	$full_day=date("{$_GET['year']}-{$_GET['month']}-{$_GET['day']}");
}
//------------------------------------------------------------------
$month=date('m');
$day=date('d');

if (isset($_GET['year'])&&isset($_GET['month']) && isset($_GET['day'])) {
	$year=$_GET['year'];
	$month=$_GET['month'];
	$day=$_GET['day'];
	$plus_button="<a id='create_todo' href=\"create_todo_page.php?year={$_GET['year']}&month={$_GET['month']}&day={$_GET['day']}\">+</a>";
}
else {
	$year=date('Y');
	$month=date('m');
	$day=date('d');
	$plus_button="<a id='create_todo' href=\"create_todo_page.php?year={$year}&month={$month}&day={$day}\">+</a>";
}

//------------------------------------------------------------------
$conn=mysqli_connect('127.0.0.1', 'BulletJournal', '111111', 'journal');

$filtered=array(
	'year' => mysqli_real_escape_string($conn, $year),
	'month' => mysqli_real_escape_string($conn, $month),
	'day' => mysqli_real_escape_string($conn, $day)
);

$filtered_date=date("{$filtered['year']}-{$filtered['month']}-{$filtered['day']}");

if(isset($user_id)) {
	$sql="SELECT * FROM {$user_id} Where date=\"{$filtered_date}\"";
}
else{
	$sql="SELECT * FROM todo_list Where date=\"{$filtered_date}\"";
}



$result=mysqli_query($conn, $sql);
if($result===false) {
	echo '에러가 생겼습니다.';
}

$list='';
while($row=mysqli_fetch_array($result)) {
	$list=$list."<li>{$row['title']}<br>
				Start: {$row['start']}--End: {$row['end']}<br>
				Description: {$row['description']}</li>
				<form action='rewrite.php' method='post'>
				<input type='hidden' name='id' value=\"{$row['id']}\">
				<input class='rewrite_button' type='submit' name='rewrite' value='rewrite'>
				</form>
				<form action='delete_process.php' method='post'>
				<input type='hidden' name='id' value=\"{$row['id']}\">
				<input type='hidden' name='date' value=\"{$row['date']}\">
				<input class='delete_button' type='submit' name='delete' value='delete'>
				</form>
				<br>";
}




?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Daily Plan</title>
	<link rel='stylesheet' href='index.css'>
	<link rel='stylesheet' href='daily.css'>
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
		<ol><?=$list?></ol>	
	</div>
</body>
</html>