<?php 

// Display all PHP errors (including notices)
error_reporting(E_ALL);

// Ensure errors are displayed
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require_once __DIR__ . '/VCard/vendor/autoload.php';
require_once __DIR__ . '/VCard/vcard/src/VCard.php';

use JeroenDesloovere\VCard\VCard;

// define vcard
$vcard = new VCard();
// define variables

$db = new dbase;
$db->query("SELECT *,Null as Password, Null as tempPassword,Null as bcryptPassword FROM Users WHERE Username =:username");
$db->bind(':username', $Username, PDO::PARAM_STR);
$views = $db->fetchSingle();
$db->closeConnection();

$firstname = $views['FirstName'];
$lastname = $views['LastName'];
$business_contact = $views['BusinessContact'];
$contact = $views['Contact'];
$job = $views['Job'];
$email = $views['EmailAddress'];
$company = $views['Organization'];
$website = $views['Website'];
$img = $views['ProfileImage'];
$linkwi_profile = base_url_dir()."/nnect/$Username";
$additional = "";
$prefix = '';
$suffix = '';
// add personal data
$vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

$vcard->addCompany($company);
$vcard->addJobtitle($job);
$vcard->addEmail($email,'Work');
$vcard->addPhoneNumber($business_contact, 'PREF;WORK');
$vcard->addPhoneNumber($contact, 'Mobile');
//$vcard->addAddress(null, null, 'street', 'worktown', null, 'workpostcode', 'Trinidad');
$vcard->addURL($website);
$vcard->addURL($linkwi_profile);
//$vcard->addLabel('street, worktown, workpostcode 868', 'work');


$vcard->addPhoto(base_url_dir()."/linkwi/images/profile-images/$img");

// return vcard as a string
//return $vcard->getOutput();

// return vcard as a download
return $vcard->download();

// echo message
//echo 'A personal vCard is saved in this folder: ' . __DIR__;

// or

// save the card in file in the current folder
// return $vcard->save();

 
  
?>