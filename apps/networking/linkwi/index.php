<?php
session_start();
ob_start();

/*check login status*/
$_SESSION['Userdata']      = array(
            'EmailAddress' => 'lampstackuser@kerwindows.com',
            'LoginRole' => 'Users',
            'UniqueID' => '66dccb065db3f66dccb065db41',
            'Username' => 'lampstackuser'
        );

require_once('../includes/linkwi.php');
require_once(LINKWI_FUNCTIONS_PATH . '/onclick.php');
require_once(LINKWI_FUNCTIONS_PATH . '/leads.php');
require_once(LINKWI_FUNCTIONS_PATH . '/profileviews.php');

require_once(LINKWI_FUNCTIONS_PATH . '/functions.php');
require_once(LINKWI_FUNCTIONS_PATH . '/custom.toasts.php');
require_once(LINKWI_CLASSES_PATH . '/aside.php');

$LoginRole = clean(sanitize($_SESSION['Userdata']['LoginRole']));
$EmailAddress = $_SESSION['Userdata']['EmailAddress'];
$Username = $_SESSION['Userdata']['Username'];
$UniqueID = $_SESSION['Userdata']['UniqueID'];

$db = new dbase;
$db->query("SELECT *, Null as Password, Null as tempPassword,Null as bcryptPassword  FROM $LoginRole WHERE EmailAddress = '$EmailAddress'");
$infouser = $db->fetchSingle();
$LoginRole = Null;
if (empty($infouser)) {
return header("Location:logout.php");
} else {
//$uniqueid = $infouser['UniqueID'];
}
$db->closeConnection();

if ($infouser['Role'] == "superadmin") {
    include(LINKWI_LOGIN_PATH . "/superadmin.php");
} elseif ($infouser['AccountType'] == 1) {
    include(LINKWI_LOGIN_PATH . "/users.php");
} elseif ($infouser['AccountType'] == 0) {
    include(LINKWI_LOGIN_PATH . "/free_users.php");
} else {
return header("Location:logout.php");
}