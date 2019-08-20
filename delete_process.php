<?php 

session_start();
$user_id=$_SESSION['user_id'];
$user_name=$_SESSION['user_name'];

$todo_list_id=$_POST['id'];
$full_day=explode('-', $_POST['date']);


$conn=mysqli_connect('127.0.0.1', 'BulletJournal', '111111', 'journal');
if($conn==false){
	echo "커넥션에서 에러가 있었습니다.";
}

if(isset($user_id)) {
	$sql="DELETE FROM {$user_id} WHERE id='$todo_list_id';";
}
else{
	$sql="DELETE FROM todo_list WHERE id='$todo_list_id';";
}

$result=mysqli_query($conn, $sql);

if($result==false){
	echo "쿼리에서 에러가 있었습니다.";
}
else{
	echo header("Location: daily.php?year={$full_day[0]}&month={$full_day[1]}&day={$full_day[2]}");
}


?>