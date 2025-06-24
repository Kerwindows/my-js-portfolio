<?php
session_start();
ob_start();

/*check login status*/
if (!$_SESSION['Userdata']['UniqueID']) {

    header("Location:login.php");
}

require('../includes/linkwi.php');
require(LINKWI_FUNCTIONS_PATH . '/functions.php');
require(LINKWI_FUNCTIONS_PATH . '/custom.toasts.php');
require(LINKWI_CLASSES_PATH . '/aside.php');


$AdminLoginRole = $_SESSION['Userdata']['LoginRole'];
$AdminEmailAddress = $_SESSION['Userdata']['EmailAddress'];
$AdminUsername = $_SESSION['Userdata']['Username'];
$AdminUniqueID = $_SESSION['Userdata']['UniqueID'];

$db = new dbase;
$db->query("SELECT *,Null as Password FROM Admin WHERE Email = '$AdminEmailAddress'");
$get_user = $db->fetchCount();
if ($get_user == 0) {
    header("Location:logout.php");
    die;
} else {
    $infouser = $db->fetchSingle();
    $db->query("SELECT * FROM roles WHERE role = '{$infouser['Role']}'");
    $user_role = $db->fetchSingle();
}
$db->closeConnection();

if ($infouser['Role'] == "1") {
    include(ADMIN_LOGIN_PATH . "/admin.php");
} else {
    header("Location:logout.php");
    die;
}