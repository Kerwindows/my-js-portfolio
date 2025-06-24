<?php

require_once __DIR__ . '/VCard/vendor/autoload.php';
require_once __DIR__ . '/VCard/vcard/src/VCard.php';

use JeroenDesloovere\VCard\VCard;


$db = new dbase;
$db->query("SELECT *,Null as Password, Null as tempPassword,Null as bcryptPassword FROM Users WHERE Username =:corporateUsername AND corporateUsername = :username ");
$db->bind(':username', $Username, PDO::PARAM_STR);
$db->bind(':corporateUsername', $Corporation, PDO::PARAM_STR);
$views = $db->fetchSingle();
$db->closeConnection();

$firstname = $views['FirstName'];
$lastname = $views['LastName'];
$business_contact = $views['BusinessContact'];
$contact = $views['Contact'];
$job = $views['Job'];
$email = $views['BusinessEmailAddress'];
$company = $views['Organization'];
$img = $views['ProfileImage'];
$linkwi_profile = base_url_dir()."/nnect/".$Corporation."/".$Username;
$additional = '';
$prefix = '';
$suffix = '';

// define vcard
$vcard = new VCard();
// add personal data
$vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

$vcard->addCompany($company);
$vcard->addJobtitle($job);
$vcard->addEmail($email, 'Work');
$vcard->addPhoneNumber($business_contact, 'PREF;WORK');
$vcard->addPhoneNumber($contact, 'Mobile');

/*can add more than 1 website*/
$vcard->addURL($linkwi_profile);
$vcard->addPhoto(base_url_dir()."/linkwi/images/profile-images/".$img);

// return vcard as a download
return $vcard->download();