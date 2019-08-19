<?php 
include("nav.php");

//---------------------------------------------------------------
$days=array('SUN', 'MON', 'TUE','WED', 'THU', 'FRI', 'SAT');
$months=array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
$days_by_months=array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

date_default_timezone_set("Asia/Seoul");
$year=date('Y');
$raw_month=(int)date('m');
if(strlen($raw_month)==1) {
	$raw_month='0'.$raw_month;
}
$this_month=(int)date('m')-1;
$selected_day=(int)date('d');


// if (isset($_GET['Year'])) {
// 	$year=date("{$_GET['Year']}");
// }

// if (isset($_GET['Month'])) {
// 	$raw_month=(int)date("{$_GET['Month']}");
// 	$this_month=(int)date("{$_GET['Month']}")-1;
// }
$selected_day_week=date('w', strtotime($year.'-'.$raw_month.'-'.$selected_day));

$total_day_num=range(1, $days_by_months[$this_month]);
$i=0;
while($i<count($total_day_num)) {
	if(strlen($total_day_num[$i])==1) {
			$total_day_num[$i]='0'.$total_day_num[$i];
	}
	$i=$i+1;
}
//----------------------------------------------------------------
$conn=mysqli_connect('127.0.0.1', 'BulletJournal', '111111', 'journal');
if($conn==false) {
	echo "커넥션에서 에러가 났습니다.";
}

if(isset($user_id)) {
	$sql= "SELECT * FROM {$user_id} WHERE date BETWEEN '{$year}-{$raw_month}-01' and '{$year}-{$raw_month}-{$days_by_months[$this_month]}' ORDER BY date ASC;";
}
else{
	$sql= "SELECT * FROM todo_list WHERE date BETWEEN '{$year}-{$raw_month}-01' and '{$year}-{$raw_month}-{$days_by_months[$this_month]}' ORDER BY date ASC;";
}


$result=mysqli_query($conn, $sql);
if($result==false) {
	echo "쿼리에서 에러가 났습니다.";
}

$mysql_date_array=array();
$i=0;
while($row=mysqli_fetch_array($result)) {
	if(isset($mysql_date_array["{$row['date']}"])) {
		array_push($mysql_date_array["{$row['date']}"], $row['title']);
	}
	else {
		$mysql_date_array["{$row['date']}"]=array($row['title']);
	}
	
}
//----------------------------------------------------------------

$i=0;

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
//---------------------------------------------------------------------
$column=0;
$counter=0;
$rest_day=$selected_day-$selected_day_week;
if(True) {
	$weekly=$weekly."<tr>\n";
		while($column<7) {
			
			//---------------------------------------------------------------------
			

			if(isset($mysql_date_array["{$year}-{$raw_month}-{$total_day_num[$rest_day-1]}"])) {
				$todays_todo_list=$mysql_date_array["{$year}-{$raw_month}-{$total_day_num[$rest_day-1]}"];
				$todays_todo_list=implode('<br>', $todays_todo_list);
			}
			if(isset($mysql_date_array["{$year}-{$raw_month}-{$total_day_num[$selected_day-1]}"])){
					$todays_todo_list=$mysql_date_array["{$year}-{$raw_month}-{$total_day_num[$selected_day-1]}"];
					$todays_todo_list=implode('<br>', $todays_todo_list);
			}
			else {
				$todays_todo_list='';
			}
			//---------------------------------------------------------------------
			if($selected_day_week<$counter || $selected_day_week==$counter){
				

				$weekly=$weekly."<td class=week_day_box>
				<a href='daily.php?year={$year}&month={$raw_month}&day={$total_day_num[$selected_day-1]}'>
				{$total_day_num[$selected_day-1]}</a><br>{$todays_todo_list}
				</td>\n";
				$selected_day=$selected_day+1;
				$counter=$counter+1;
				$column=$column+1;
			}
			else {
				$weekly=$weekly."<td class=week_day_box>
				<a href='daily.php?year={$year}&month={$raw_month}&day={$total_day_num[$rest_day-1]}'>
				{$total_day_num[$rest_day-1]}</a><br>{$todays_todo_list}
				</td>\n";
				$rest_day=$rest_day+1;
				$counter=$counter+1;
				$column=$column+1;
				
			}
		}
	$weekly=$weekly."</tr>\n";
}

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Weekly Plan</title>
	<link rel='stylesheet' href='index.css'>
	<script type='text/JavaScript' src='index.js'></script>
</head>
<body>
	<header>
		<h1 id='title'>Weekly Plan</h1>
		<div id='main_menu'>
			<nav><?=$nav_list?></nav>
		</div>
	</header>
	<div id='weekly'>
		<h2 id='this_month'><?=$year.'-'.$raw_month?></h2>
		<table>
			<?=$weekly?>
		</table>
	</div>
</body>
</html>