

function get_this_month() {
	var n = new Date();
	window.this_month = n.getMonth();
	var months = new Array ('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
	document.getElementById('this_month').innerHTML=months[this_month];
}

function get_calendar() {
	var days= new Array ('SUN', 'MON', 'TUE','WED', 'THU', 'FRI', 'SAT');
	var n = new Date();
	n.setDate(1);
	var first_day_of_month = days[n.getDay()];
//----------------------------------------------
	var how_many_days_in_months = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	var total_day_num = new Array();
	var i = 1;
	while (i<(how_many_days_in_months[window.this_month]+1)) {
		total_day_num.push(i);
		i=i+1;
	}
	var day_box_array = document.getElementsByClassName('day_box');
	i=0;
	while (i<total_day_num.length) {
		day_box_array[i+(n.getDay())].innerHTML=i+1;
		if (i===(how_many_days_in_months[window.this_month])) {
			break;
		}
		i=i+1;
	}
}