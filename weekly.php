<?php 
$nav_array= array('home', 'monthly', 'weekly', 'daily');
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
//---------------------------------------------------------------
$days=array('SUN', 'MON', 'TUE','WED', 'THU', 'FRI', 'SAT');
$months=array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');

$days_by_months=array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
$today_and_month=date('Y-m-d');
$this_month=(int)date('m')-1;
$first_day_start=date('w', strtotime($today_and_month.'-01'));

$total_day_num=range(1, $days_by_months[$this_month]);

$num_day=array();
$i=0;
// while($i<count($total_day_num)) {
	
// }

$weekly='';
$n=0;
if(True) {
	$weekly=$weekly."<tr>\n";
		while($n<7) {
			$weekly=$weekly."<th id=week{$n}>{$days[$n]}</th>\n";
			$n=$n+1;
		}
	$weekly=$weekly."</tr>\n";
}

$column=0;

if(True) {
	$weekly=$weekly."<tr>\n";
		while($column<7) {
			$weekly=$weekly."<td class=day_box></td>\n";
			$column=$column+1;
		}
	$weekly=$weekly."</tr>\n";
}

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Monthly Plan</title>
	<link rel='stylesheet' href='index.css'>
	<script type='text/JavaScript' src='index.js'></script>
</head>
<body onload='get_this_month(); 
				get_weekly();'>
	<header>
		<h1 id='title'>Weekly Plan</h1>
		<div id='main_menu'>
			<nav><?=$nav_list?></nav>
		</div>
	</header>
	<div id='weekly'>
		<h2 id='this_month'></h2>
		<table>
			<?=$weekly?>
		</table>
	</div>
	<?php print_r($total_day_num)?>
</body>
</html>