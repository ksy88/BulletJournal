<?php 
include("nav.php");

//---------------------------------------------------------------


//-----------------------------------------------------------------
date_default_timezone_set("Asia/Seoul");
$days=array('SUN', 'MON', 'TUE','WED', 'THU', 'FRI', 'SAT');
$months=array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
$days_by_months=array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
$year=date('Y');
$raw_month=(int)date('m');
if(strlen($raw_month)==1) {
	$raw_month='0'.$raw_month;
}

$this_month=(int)date('m')-1;



if (isset($_GET['Year'])) {
	$year=date("{$_GET['Year']}");
}

if (isset($_GET['Month'])) {
	$raw_month=(int)date("{$_GET['Month']}");
		if(strlen($raw_month)==1) {
			$raw_month='0'.$raw_month;
		}
	$this_month=(int)date("{$_GET['Month']}")-1;
}



$first_day_start=date('w', strtotime($year.'-'.$raw_month.'-01'));

$total_day_num=range(1, $days_by_months[$this_month]);
//-------------------------------------------------------------
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
	
//----------------------------------------------------------
$num_day=array();
$i=0;
$calendar='';
$n=0;
if(True) {
	$calendar=$calendar."<tr>\n";
		while($n<7) {
			$calendar=$calendar."<th id=week{$n}>{$days[$n]}</th>\n";
			$n=$n+1;
		}
	$calendar=$calendar."</tr>\n";
}

$row=0;
$column=0;
$i=0;
$counter=0;
while($row<6) {
	$calendar=$calendar."<tr>\n";
		
		while($column<7) {
			if($first_day_start-1<$counter && $counter<$days_by_months[$this_month]+$first_day_start){
				if(strlen($total_day_num[$i])==1) {
					$total_day_num[$i]='0'.$total_day_num[$i];
				}

				if(isset($mysql_date_array["{$year}-{$raw_month}-{$total_day_num[$i]}"])) {
					$todays_todo_list=$mysql_date_array["{$year}-{$raw_month}-{$total_day_num[$i]}"];
					$todays_todo_list=implode('<br>', $todays_todo_list);
				}
				else {
					$todays_todo_list='';
				}
				
				
				$calendar=$calendar."
				<td class=month_day_box>
				<a href='daily.php?year={$year}&month={$raw_month}&day={$total_day_num[$i]}'>
				{$total_day_num[$i]}
				</a> <br>
				{$todays_todo_list}
				</td>\n";
				$i=$i+1;
				$counter=$counter+1;
			}
			else {
				$calendar=$calendar."<td class=month_day_box></td>\n";
				$counter=$counter+1;
			}
			$column=$column+1;
		}
	$column=0;
	$calendar=$calendar."</tr>\n";
	$row=$row+1;
}
//----------------------------------------------------------------------



?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Monthly Plan</title>
	<link rel='stylesheet' href='index.css'>
	<script type='text/JavaScript' src='index.js'></script>
</head>
<body>
	<header>
		<h1 id='title'>Monthly Plan</h1>
		<div id='main_menu'>
			<nav><?=$nav_list?></nav>
		</div>
	</header>

	<div id='calendar'>
		<h2 id='this_month'>
			<a href="monthly.php?Year=<?php 
			if($raw_month==1){
				echo $year-1;
			}
			else {
				echo $year;
			}
			?>
			&Month=<?php 
			if($raw_month==1){
				$raw_month=12;
				echo $raw_month;
			}
			else{
			echo $raw_month-1;}?>
			"><=</a>
			<?php 
			echo $year.' '.$months[$this_month]?>
			<a href="monthly.php?Year=<?php 
			if($this_month==11){
				echo $year+1;
			}
			else {
				echo $year;
			}?>
			&Month=<?php 
			if($this_month==11){
				$this_month=1;
				echo $this_month;
			}
			else{
				echo $this_month+2;
			}?>
			">=></a>
		</h2>
		<table>
			<?=$calendar?>
		</table>
	</div>
</body>
</html>