<?php 
function weekOfMonth($date) {
    //Get the first day of the month.
    $firstOfMonth = strtotime(date("Y-m-01", $date));
    //Apply above formula.
    return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
}

function weekOfYear($date) {
    $weekOfYear = intval(date("W", $date));
    if (date('n', $date) == "1" && $weekOfYear > 51) {
        // It's the last week of the previos year.
        $weekOfYear = 0;    
    }
    return $weekOfYear;
}



$todays_date = '2';
$month = '6';
$year = '2022';

echo weekOfMonth(strtotime("".$year."-".$month."-".$todays_date.""));

echo $d = cal_days_in_month(CAL_GREGORIAN,$month, $year);

$firstDay  = $todays_date - 3;
if(($todays_date - 3)==-2){
$firstDay  = $todays_date;
}
if(($todays_date - 3)==-1){
$firstDay  = $todays_date - 1;
}
if(($todays_date - 3)==0){
$firstDay  = $todays_date - 2;
}

$lastDay = $todays_date + 3;
if(($todays_date + 3)==$d+1){
$lastDay  = $todays_date +2;
}
if(($todays_date + 3)==$d+2){
$lastDay  = $todays_date +1;
}
if(($todays_date + 3)==$d+3){
$lastDay  = $todays_date;
}

$days = range($firstDay,$lastDay);

for($i=0;$i<count($days);$i++)
{
 
$place="th";

if($days[$i] == 1 || $days[$i] ==21 ||$days[$i] ==31){
$place="st";
}
if($days[$i] == 2 || $days[$i] ==22){
$place="nd";
}
if($days[$i] == 3 || $days[$i] ==23){
$place="rd";
}
$dataData[] = $days[$i].$place;
}
echo json_encode($dataData);