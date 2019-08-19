<?php 
if($_POST['user_id']=='' || $_POST['user_pw']=='') {
	exit('Write your ID and password');
}

$user_id=$_POST['user_id'];
$user_pw=$_POST['user_pw'];

$conn=mysqli_connect('127.0.0.1', 'BulletJournal', '111111', 'journal');
if($conn==false) {
	echo "there is an error in connecting with database";
}

$sql="SELECT * FROM login_list;";

$result=mysqli_query($conn, $sql);
if($result==false) {
	echo "there is an error in query";
}

$members=array();
while($row=mysqli_fetch_array($result)) {
	$members["{$row['user_id']}"]=array('pw'=>$row['user_pw'], 'name'=>$row['user_name']);
}

if(!isset($members[$user_id])) {
	exit("<script>alert('ID or Password is wrong. Try again.');history.go(-1);</script>");
}
if($members[$user_id]['pw']!= $user_pw) {
	exit("<script>alert('ID or Password is wrong. Try again.');history.go(-1);</script>");
}

session_start();
$_SESSION['user_id']=$user_id;
$_SESSION['user_name']=$members[$user_id]['name'];
?>
<meta http-equiv="refresh" content="0; url=index.php">