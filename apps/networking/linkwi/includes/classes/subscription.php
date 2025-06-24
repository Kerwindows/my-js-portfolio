<?php 

class Subs {

public 

function_construct($uniqueid) {

$db = new dbase;
$db->query("SELECT * FROM Users WHERE UniqueID = '$uniqueid' ")
$user = $db->fetchSingle();

$client = $user['UniqueID'];
$accountType = $user['AccountType'];
	
$this->client = $client;
$this->accountType = $accountType;

$db = NULL;

}

public function getSub() {

	$db->query("SELECT * FROM Subscription_Time WHERE UniqueID = '$this->client' ")
	$sub = $db->fetchSingle();
	$start = $sub['Start'];
	$end = $sub['End'];
	
	$this->start = $start;
	$this->end = $end;

	$this->diff = abs(strtotime($this->start) - strtotime($this->end));
	return $this->diff;


}


public function ExpiredSub() {

if($this->diff <= 0){

	$db->query("UPDATE Users SET AccountType ='0' WHERE UniqueID = '$this->client'")
	$db->execute();

}
else {}


}

}

?>