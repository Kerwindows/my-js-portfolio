<?php class SocialClickCount {

 public $todays_date;
 public $monthDaysCount; 
 public function __construct($uniqueid,$month,$year) {
		$SocialArray = array();
		$db = new dbase;
		$db->query("SELECT Social FROM View_Social_Stats WHERE UniqueID = '$uniqueid' AND MONTH(Date) = '$month' and YEAR(Date) = '$year' GROUP BY Social ORDER BY Social ");
		$this->getRs = $db->fetchMultiple();
		foreach ($this->getRs as $R) {
			if ($R['Social'] != "") {
				$SocialArray[] = ucfirst($R['Social']);
				$SocialArrayLC[] = $R['Social'];
			}
		}

		$this->SocialArray = $SocialArray;
		$this->SocialArrayLC = $SocialArrayLC;
		$this->uniqueid = $uniqueid;
		$this->month = $month;
		$this->year = $year;
		
		$db = NULL;
		}
public function showSocials() {	
return json_encode($this->SocialArray);
}
		
public function getSocial() {	
if(empty($this->SocialArray)){
		$fbLabel = json_encode([0]);
		return $fbLabel;
		}
		else{
		$db = new dbase;

		$query = '';
		$fbLabel = [];
		for ($x = 0;$x < count($this->SocialArray);$x++) {

			if ($x == (count($this->SocialArray) - 1)) {
				$comma = "";
			}
			else {
				$comma = ",";
			}

			$query .= "SUM(if(Social = '" . $this->SocialArray[$x] . "', 1, 0)) AS `" . lcfirst($this->SocialArray[$x]) . "`$comma";
		}


$db->query("SELECT $query ,Date FROM View_Social_Stats WHERE UniqueID = '$this->uniqueid' AND MONTH(Date) = '$this->month' and YEAR(Date) = '$this->year' GROUP BY Date ORDER BY Date");
return $this->monthDaysCountaterow = $db->fetchMultiple(); 
}
}
public function getSocialDays(){ 
$firstDay  = $this->todays_date - 3;
		if(($this->todays_date - 3)==-2){
		$firstDay  = $this->todays_date;
		}
		if(($this->todays_date - 3)==-1){
		$firstDay  = $this->todays_date - 1;
		}
		if(($this->todays_date - 3)==0){
		$firstDay  = $this->todays_date - 2;
		}
		
		$lastDay = $this->todays_date + 3;
		if(($this->todays_date + 3)==$this->monthDaysCount+1){
		$lastDay  = $this->todays_date +2;
		}
		if(($this->todays_date + 3)==$this->monthDaysCount+2){
		$lastDay  = $this->todays_date +1;
		}
		if(($this->todays_date + 3)==$this->monthDaysCount+3){
		$lastDay  = $this->todays_date;
		}
		
		return $this->monthDaysCountays = range($firstDay,$lastDay);

}


public function getSocialClickDays(){  
 
		
		for($i=0;$i<count($this->getSocialDays());$i++)
		{
		 
		$place='th';
		
		if($this->monthDaysCountays[$i] == 1 || $this->monthDaysCountays[$i] ==21 ||$this->monthDaysCountays[$i] ==31){
		$place="st";
		}
		if($this->monthDaysCountays[$i] == 2 || $this->monthDaysCountays[$i] ==22){
		$place="nd";
		}
		if($this->monthDaysCountays[$i] == 3 || $this->monthDaysCountays[$i] ==23){
		$place="rd";
		}
		$dataData[] = $this->monthDaysCountays[$i].$place;
		}
		return json_encode($dataData);

}
public function getSocialClickCount($Social){   
$fbdate = [];
$fbLabel = [];
foreach($this->getSocial() as $datez){
if(empty($fbdate)){
		
		if($datez[$Social] !=0){
		$fbdate[] = set_date_time('d',$datez["Date"]);
	 		$fb[] = $datez[$Social];
	 		}
	}
	else{
		if(array_key_exists(set_date_time('d',$datez["Date"]),$fbdate)){
	   		continue;
	  	}else{
	 		
	 		if($datez[$Social] !=0){
	 		$fbdate[] = set_date_time('d',$datez["Date"]);
	 		$fb[] = $datez[$Social];
	 		}
	  	}
	}
}

foreach ($this->getSocialDays() as $number) {
if (in_array($number, $fbdate)) {
  //get position of value in array i.e. key

   $removed = array_shift($fb);
   $fbLabel[] = $removed;
  } else {
   $fbLabel[] = "0";
  }
 }
return json_encode($fbLabel);
}
public function getEverything(){
foreach($this->SocialArrayLC as $y){
$g[] = $this->getSocialClickCount($y);
}
//return json_encode(str_replace('"',"",$g));
return "[".implode(',', $g)."]";
}

}