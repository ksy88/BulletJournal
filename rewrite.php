<?php 

$target_post_id=$_POST['id'];

$conn=mysqli_connect('127.0.0.1', 'BulletJournal', '111111', 'journal');
if($conn==false) {
	echo "커넥션에서 에러가 났습니다.";
}


if(isset($user_id)) {
	$sql= "SELECT * FROM {$user_id} WHERE id='{$target_post_id}';";
}
else{
	$sql= "SELECT * FROM todo_list WHERE id='{$target_post_id}';";
}

$result=mysqli_query($conn, $sql);
if($result==false) {
	echo "쿼리에서 에러가 났습니다.";
}

$target_data=array();
while($row=mysqli_fetch_array($result)) {
	$target_data['id']=$row['id'];
	$target_data['date']=$row['date'];
	$target_data['title']=$row['title'];
	$target_data['start']=$row['start'];
	$target_data['end']=$row['end'];
	$target_data['description']=$row['description'];
}


?>
<!DOCTYPE html>
<html>
	<head>
		<link rel='stylesheet' href='rewrite_delete.css'>
	</head>
	<body>
		<form action='rewrite_process.php' method='post'>
			<div class='form_small_wrap'>
			<div class='border'> 
			<table>
				<tr>
					<td colspan="2"><h1 class='title'>Rewrite</h1></td>
				</tr>
				<tr>
					<td>Title : </td>
					<td tabindex="1"><input type='text' name='title' value="<?=$target_data['title']?>"></td>
				</tr>
				<tr>
					<td>Start : </td>
					<td tabindex="2"><input type='time' name='start'></td>
				</tr>
				<tr>
					<td>End : </td>
					<td tabindex="3"><input type='time' name='end'></td>
				</tr>
				<tr>
					<td>Description : </td>
					<td tabindex="4"><textarea name='description'><?=$target_data['description']?></textarea></td>
				</tr>
				<tr>
					<td colspan="2" tabindex="5"><input id='save_button' type='submit' value='save'></td>
				</tr>
			</table>
			</div>
		</div>
		<input type='hidden' name='id' value="<?=$target_data['id']?>">
		<input type='hidden' name='date' value="<?=$target_data['date']?>">
		</form>
	</body>
</html>