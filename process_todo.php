<?php

session_start();
$user_id=$_SESSION['user_id'];
$user_name=$_SESSION['user_name'];


$before_url=strval($_SERVER['HTTP_REFERER']);
$before_url=str_replace("http://{$_SERVER['SERVER_NAME']}", '', $before_url);
$before_url=str_replace('/BulletJournal/create_todo_page.php?year=', '', $before_url);
$before_url=str_replace('&month=', '/', $before_url);
$before_url=str_replace('&day=', '/', $before_url);
$full_day=explode('/', $before_url);
date_default_timezone_set("Asia/Seoul");

$date=$full_day[0].'-'.$full_day[1].'-'.$full_day[2];

$conn=mysqli_connect('127.0.0.1', 'BulletJournal', '111111', 'journal');

if($conn===false) {
	echo "커넥션에서 문제가 있습니다.";
}

$filtered=array(
	'date' => mysqli_real_escape_string($conn, $date),
	'title' => mysqli_real_escape_string($conn, $_POST['todo_title']),
	'start' => mysqli_real_escape_string($conn, $_POST['todo_start_time'].':00'),
	'end' => mysqli_real_escape_string($conn, $_POST['todo_end_time'].':00'),
	'description' => mysqli_real_escape_string($conn, $_POST['description']),
	'done' => mysqli_real_escape_string($conn, 0)
);

$sql="INSERT INTO {$user_id}(date, title, start, end, description, done)
		VALUES(
			'{$filtered['date']}',
			'{$filtered['title']}',
			'{$filtered['start']}',
			'{$filtered['end']}',
			'{$filtered['description']}',
			'{$filtered['done']}'
		);";

$result=mysqli_query($conn, $sql);

if($result===false) {
	echo '에러가 생겼습니다.';
}
else {
	header("Location: daily.php?year={$full_day[0]}&month={$full_day[1]}&day={$full_day[2]}");
}


?>