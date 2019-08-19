<?php 

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
	$print_login_info="<p><a id='sign_up' href='sign_up.php'>sign up now!</a></p>";
	$print_login_info=$print_login_info."<p><a id='login_button' href='login.php'>Login</a></p>";
}
else {
	$user_id=$_SESSION['user_id'];
	$user_name=$_SESSION['user_name'];
	$print_login_info="<p id=say_hello>Hello, {$user_name}!</p>";
	$print_login_info=$print_login_info."<p><a id='logout' href='logout.php'>Logout</a></p>";
}
?>