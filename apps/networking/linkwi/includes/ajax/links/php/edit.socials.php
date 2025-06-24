<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

require ('../../../../../includes/linkwi.php');

$db                  = new dbase;
$userid = custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV);
$Facebook  = clean(sanitize(filter_var($_POST['facebook'], FILTER_SANITIZE_URL)));
$Instagram = clean(sanitize(filter_var($_POST['instagram'], FILTER_SANITIZE_URL)));
$TikTok = clean(sanitize(filter_var($_POST['tiktok'], FILTER_SANITIZE_URL)));
$Twitter = clean(sanitize(filter_var($_POST['twitter'], FILTER_SANITIZE_URL)));
$YouTube = clean(sanitize(filter_var($_POST['youtube'], FILTER_SANITIZE_URL)));
$LinkedIn = clean(sanitize(filter_var($_POST['linkedin'], FILTER_SANITIZE_URL)));
$Whatsapp = clean(sanitize(filter_var($_POST['whatsapp'], FILTER_SANITIZE_URL)));

$db->query('UPDATE `Users` SET 
Facebook  = :facebook,
Instagram = :instagram,
TikTok = :tiktok,
Twitter = :twitter,
YouTube = :youtube,
LinkedIn = :linkedin,
Whatsapp = :whatsapp
WHERE UniqueID 		= :userid');

$db->bind(':userid', $userid, PDO::PARAM_STR);
$db->bind(':facebook', $Facebook, PDO::PARAM_STR);
$db->bind(':instagram', $Instagram, PDO::PARAM_STR);
$db->bind(':tiktok', $TikTok, PDO::PARAM_STR);
$db->bind(':twitter', $Twitter, PDO::PARAM_STR);
$db->bind(':youtube', $YouTube, PDO::PARAM_STR);
$db->bind(':linkedin', $LinkedIn, PDO::PARAM_STR);
$db->bind(':whatsapp', $Whatsapp , PDO::PARAM_STR);
$db->execute();
$db->closeConnection();
}