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
$year=date('Y');
$raw_month=date('m');
$this_month=(int)date('m')-1;
if (isset($_GET['id'])) {
	$raw_month=date("{$_GET['id']}");
	$this_month=(int)date("{$_GET['id']}")-1;
}

$first_day_start=date('w', strtotime($year.'-'.$raw_month.'-01'));

$total_day_num=range(1, $days_by_months[$this_month]);

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
$month=$this_month+1;
while($row<6) {
	$calendar=$calendar."<tr>\n";
		
		while($column<7) {
			if($first_day_start-1<$counter && $counter<$days_by_months[$this_month]+$first_day_start){
				$calendar=$calendar."<td class=day_box>
				<a href='daily.php?month={$month}&day={$total_day_num[$i]}'>
				{$total_day_num[$i]}</a>
				</td>\n";
				$i=$i+1;
				$counter=$counter+1;
			}
			else {
				$calendar=$calendar."<td class=day_box></td>\n";
				$counter=$counter+1;
			}
			$column=$column+1;
		}
	$column=0;
	$calendar=$calendar."</tr>\n";
	$row=$row+1;

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
<body>
	<header>
		<h1 id='title'>Monthly Plan</h1>
		<div id='main_menu'>
			<nav><?=$nav_list?></nav>
		</div>
	</header>

	<div id='calendar'>
		<h2 id='this_month'>
			<a href="monthly.php?id=<?php echo $this_month;?>"><=</a>
			<?=$year.' '.$months[$this_month]?>
			<a href="monthly.php?id=<?php echo $this_month+2;?>">=></a>
		</h2>
		<table>
			<?=$calendar?>
		</table>
	</div>

</body>
</html>