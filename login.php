<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="login_sign_up.css">
</head>
	<header>
	</header>
	<body>
	
		<form action='login_check.php' method='post'>
			<div class='form_small_wrap'>
			<div class='border'>
			<table>
				<tr>
					<td colspan="3"><h1 class='title'>Login</h1></td>
				</tr>
				<tr>
					<td>ID : </td>
					<td><input type='text' name='user_id' placeholder='ID' tabindex="1"></td>
					<td rowspan='2'><input id='login_button' type='submit' value='Login' tabindex="3"></td>
				</tr>
				<tr>
					<td>PW : </td>
					<td><input type='password' name='user_pw' placeholder='Password' tabindex="2"></td>
				</tr>
			</table>
			</div>
		</div>
		</form>
	</body>
</html>