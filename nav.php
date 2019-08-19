<?php 

session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user_id=$_SESSION['user_id'];
	$user_name=$_SESSION['user_name'];
}

$nav_array= array('home', 'monthly', 'weekly', 'daily');

if(isset($user_id)) {
	array_push($nav_array, 'logout');
}

$nav_list='';
$i=0;
while($i<count($nav_array)) {
	if($nav_array[$i]!='home'){
		$nav_list=$nav_list."<a href=\"{$nav_array[$i]}.php\">{$nav_array[$i]}</a>";
		$i=$i+1;
	}
	else {
		$nav_list=$nav_list."<a href=\"index.php\">{$nav_array[$i]}</a>";
		$i=$i+1;
	}
}



?>