<?php 
require ('../../../../../includes/linkwi.php');

function new_OnClick($button,$id){

$user_ip = getenv('REMOTE_ADDR');
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
$country = $geo["geoplugin_countryName"];
$city = $geo["geoplugin_city"];
$date = date("Y-m-d");

if(!isset($_COOKIE[$button.$id])){
	setCookie($button.$id,'yes',time()+(60*60*24*30));
	$db = new dbase;
	$db->query("UPDATE Views SET $button = $button + 1 WHERE UniqueID =:id");
	$db->bind(':id', $id, PDO::PARAM_STR);
	$db->execute();
	
$db->query("INSERT INTO View_Social_Stats (City,UniqueID,Date,Social) VALUES (:country,:id,:date,:button)");
$db->bind(':country', $country, PDO::PARAM_STR);
$db->bind(':id', $id, PDO::PARAM_STR);
$db->bind(':date', $date, PDO::PARAM_STR);
$db->bind(':button', $button, PDO::PARAM_STR);
$db->execute();

}
}

new_OnClick($_POST['button'],custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV));

echo $_POST['button'];
echo custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV);
?>