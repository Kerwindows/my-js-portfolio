<?php



include "../../includes/databaseconnect.php";
$ip_add = stripslashes(htmlspecialchars($_POST['ip_add']));
$s_unique_id = stripslashes(htmlspecialchars($_POST['s_unique_id']));
$invoice = stripslashes(htmlspecialchars($_POST['invoice']));

$s_firstname = stripslashes(htmlspecialchars($_POST['s_firstname']));
$s_lastname = stripslashes(htmlspecialchars($_POST['s_lastname']));
$s_street = stripslashes(htmlspecialchars($_POST['s_street']));
$s_town = stripslashes(htmlspecialchars($_POST['s_town']));
$s_country = stripslashes(htmlspecialchars($_POST['s_country']));
$s_contact = stripslashes(htmlspecialchars($_POST['s_contact']));
$s_email = stripslashes(htmlspecialchars($_POST['s_email']));

$b_firstname = stripslashes(htmlspecialchars($_POST['b_firstname']));
$b_lastname = stripslashes(htmlspecialchars($_POST['b_lastname']));
$b_street = stripslashes(htmlspecialchars($_POST['b_street']));
$b_town = stripslashes(htmlspecialchars($_POST['b_town']));
$b_country = stripslashes(htmlspecialchars($_POST['b_country']));
$b_contact = stripslashes(htmlspecialchars($_POST['b_contact']));
$b_email = stripslashes(htmlspecialchars($_POST['b_email']));

$insert_billing_shipping = "INSERT INTO `billing_shipping` (`sb_id`, `ip_add`, `s_unique_id`, `invoice`, `s_firstname`, `s_lastname`, `s_contact`, `s_email`, `s_street`, `s_town`, `s_country`, `s_zip`, `b_firstname`, `b_lastname`, `b_contact`, `b_email`, `b_street`, `b_town`, `b_country`, `b_zip`) VALUES ('', '$ip_add', '$s_unique_id','$invoice', '$s_firstname','$s_lastname','$s_contact','$s_email','$s_street', '$s_town', '$s_country','', '$b_firstname','$b_lastname','$b_contact','$b_email','$b_street', '$b_town', '$b_country','')";

$run_billing_shipping = mysqli_query($conn,$insert_billing_shipping);

if($run_billing_shipping){}