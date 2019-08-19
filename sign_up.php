<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link rel="stylesheet" href="login_sign_up.css">
	<header>
	</header>
	<body>
		<form action='sign_up_process.php' method='post'>
			<div class='form_small_wrap'>
			<div class='border'>
			<table>
				<tr>
					<td colspan="2"><h1 class='title'>Sign Up</h1></td>
				</tr>
				<tr>
					<td>ID : </td>
					<td tabindex="1"><input type='text' name='new_user_id' placeholder='Put ID'></td>
				</tr>
				<tr>
					<td>Password : </td>
					<td tabindex="2"><input type='text' name='new_user_pw1' placeholder='Put Password'></td>
				</tr>
				<tr>
					<td>Re-enter Password : </td>
					<td tabindex="3"><input type='text' name='new_user_pw2' placeholder='Put Password'></td>
				</tr>
				<tr>
					<td>User-Name : </td>
					<td tabindex="4"><input type='text' name='new_user_name' placeholder='Put User-Name'></td>
				</tr>
				<tr>
					<td colspan="2" tabindex="5"><input id='sign_up_button' type='submit' value='sign up'></td>
				</tr>
			</table>
			</div>
		</div>
		</form>
	</body>
</html>