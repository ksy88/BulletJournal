<?php 
if($_POST['new_user_pw1']!=$_POST['new_user_pw2']) {
	echo "<script>alert('Password is not matched. Try again!');history.go(-1);</script>";
	exit;
}

$conn=mysqli_connect('127.0.0.1', 'BulletJournal', '111111', 'journal');
if($conn==false) {
	echo "there is an error in connecting with database";
}

$sql="SELECT user_id FROM login_list;";

$result=mysqli_query($conn, $sql);
if($result==false) {
	echo "there is an error in query";
}

$user_id_list=array();
while($row=mysqli_fetch_array($result)) {
	$user_id_list["{$row['user_id']}"]=$row['user_id'];
}

if(isset($user_id_list[$_POST['new_user_id']])) {
	echo "<script>alert('ID that you just entered is already taken. Try again!');history.go(-1);</script>";
	exit;
}
//----------------------------------------------
$new_user_id=mysqli_real_escape_string($conn, $_POST['new_user_id']);
$new_user_pw=mysqli_real_escape_string($conn, $_POST['new_user_pw1']);
$new_user_name=mysqli_real_escape_string($conn, $_POST['new_user_name']);

$sql="INSERT INTO login_list(user_id, user_pw, user_name)
					VALUES('{$new_user_id}', '{$new_user_pw}', '{$new_user_name}');";

$result=mysqli_query($conn, $sql);
if($result==false) {
	echo "there is an error in query";
}
//----------------------------------------------
$sql="CREATE TABLE {$new_user_id}(
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		date date NOT NULL,
		title VARCHAR(50) NOT NULL,
		start TIME,
		end TIME,
		description TEXT,
		done TINYINT(1)
	);";

$result=mysqli_query($conn, $sql);
if($result==false) {
	echo "there is an error in query";
}
else{
	echo "Register is finished. <a href='index.php'>GO BACK TO HOMEPAGE</a>";
}
?>