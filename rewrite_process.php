<?php 

session_start();
$user_id=$_SESSION['user_id'];
$user_name=$_SESSION['user_name'];


$full_day=explode('-', $_POST['date']);

$conn=mysqli_connect('127.0.0.1', 'BulletJournal', '111111', 'journal');
if($conn==false){
	echo "커넥션에서 에러가 있었습니다.";
}

$filtered_info=array(
	'date'=>mysqli_real_escape_string($conn, $_POST['date']),
	'title'=>mysqli_real_escape_string($conn, $_POST['title']),
	'start'=>mysqli_real_escape_string($conn, $_POST['start'].':00'),
	'end'=>mysqli_real_escape_string($conn, $_POST['end'].':00'),
	'description'=>mysqli_real_escape_string($conn, $_POST['description']),
	'id'=>mysqli_real_escape_string($conn, $_POST['id'])
);


if(isset($user_id)) {
	$sql="UPDATE {$user_id} 
		SET title='{$filtered_info['title']}', 
			start='{$filtered_info['start']}',
			end='{$filtered_info['end']}',
			description='{$filtered_info['description']}'
		WHERE id='{$filtered_info['id']}';";
}
else{
	$sql="UPDATE todo_list 
		SET title='{$filtered_info['title']}', 
			start='{$filtered_info['start']}',
			end='{$filtered_info['end']}',
			description='{$filtered_info['description']}'
		WHERE id='{$filtered_info['id']}';";
}

$result=mysqli_query($conn, $sql);

if($result==false){
	echo "쿼리에서 에러가 있었습니다.";
}
else{
	echo header("Location: daily.php?year={$full_day[0]}&month={$full_day[1]}&day={$full_day[2]}");
}

// echo $sql;

?>