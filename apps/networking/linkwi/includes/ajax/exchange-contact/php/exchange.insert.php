<?php
require ('../../../../../includes/linkwi.php');

$userid 		= custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV);
$exchange_username		= clean(sanitize($_POST["exchange_username"]));

if(!empty($exchange_username)){
$db = new dbase; 
$db->query("SELECT `FirstName`, `LastName`, `BusinessContact`, `BusinessEmailAddress` FROM Users WHERE Username = '$exchange_username'");
$getExchangeInfo = $db->fetchSingle();
if(empty($db->fetchSingle())){
echo json_encode(["error" => "user cannot be found"]); 
    exit();

}

$db->query("INSERT INTO `Leads` (`FirstName`, `LastName`, `Username`, `EmailAddress`, `Contact`, `User_Linked`,`Date`) VALUES (:firstname, :lastname, :username, :email, :contact, :userid, :datestamp)");
  $db->bind(':userid', $userid, PDO::PARAM_STR);
    $db->bind(':firstname', $getExchangeInfo['FirstName'], PDO::PARAM_STR);
    $db->bind(':lastname',  $getExchangeInfo['LastName'], PDO::PARAM_STR);
    $db->bind(':username', $exchange_username, PDO::PARAM_STR);
    $db->bind(':email',  $getExchangeInfo['BusinessEmailAddress'], PDO::PARAM_STR);
    $db->bind(':contact',  $getExchangeInfo['BusinessContact'], PDO::PARAM_STR);
     $db->bind(':datestamp',Date('Y-m-d'), PDO::PARAM_STR);

$run 		= $db->execute();
    if($run){
    echo json_encode(["error" => ""]); 
    
    }else{
    echo json_encode(["error" => "Error saving contact"]); 
    exit();
    } 
}else{


$exchange_firstname		= clean(sanitize($_POST["exchange_firstname"]));
$exchange_lastname		= clean(sanitize($_POST["exchange_lastname"]));

$exchange_email		= clean(sanitize(val_email($_POST["exchange_email"])));
$exchange_contact		= clean(sanitize($_POST["exchange_contact"]));
$exchange_met_at		= clean(sanitize($_POST["exchange_met_at"]));

    $db = new dbase; 
    $db->query("INSERT INTO `Leads` (`FirstName`, `LastName`, `EmailAddress`, `Contact`, `User_Linked`, `Met`, `Date`) VALUES (:firstname, :lastname, :email, :contact, :userid, :met_at, :datestamp)");
    $db->bind(':userid', $userid, PDO::PARAM_STR);
    $db->bind(':firstname', $exchange_firstname, PDO::PARAM_STR);
    $db->bind(':lastname', $exchange_lastname, PDO::PARAM_STR);
    $db->bind(':email', $exchange_email, PDO::PARAM_STR);
    $db->bind(':contact', $exchange_contact, PDO::PARAM_STR);
    $db->bind(':met_at', $exchange_met_at, PDO::PARAM_STR);
    $db->bind(':datestamp',Date('Y-m-d'), PDO::PARAM_STR);
    
    $run 		= $db->execute();
    if($run){
    echo json_encode(["error" => ""]); 
    
    }else{
    echo json_encode(["error" => "Error saving contact"]); 
    exit();
    } 
}