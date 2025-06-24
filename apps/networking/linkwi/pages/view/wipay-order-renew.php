<?php
session_start();
if (!defined('PROJECT_PATH')) {

    exit("<script>window.open('https://linkwi.co/we-see-you.php','_self')</script>");
}
// Set time zone stamp
$tz = 'America/Port_of_Spain';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp

// Format current date and time
$Dateandtime = $dt->format('Y-m-d g:i:s a');
$day = $dt->format('D M Y');
$tyme = $dt->format('g:i:s a');

// Add 1 year to the date
$dt->modify('+1 year');
$expDate = $dt->format('Y-m-d g:i:s a');

require LINKWI_FUNCTIONS_PATH . '/functions.php';
include LINKWI_INCLUDES_PATH . '/linkwi.shop.head.php';
include LINKWI_CLASSES_PATH . '/send.Email.php';
$email = new sendMessage;

$customer_id = $_SESSION['Userdata']['UniqueID'];
//$ip_add = $_SESSION['ip_add'];



$status         = $_GET['status'];

//$invoice comesfrom url




if ($status == "failed") {
    //set_error_msg('Transaction Failed. Please contact support');
    echo "<script>alert('Transaction Failed.')</script>";
    echo "<script>window.open('../../linkwi/?my-subscriptions','_self')</script>";
    //header("Location: ../../checkout");
    die();
}
if ($status == "error") {
    echo "<script>alert('Transaction Error')</script>";
    echo "<script>window.open('../../linkwi/?my-subscriptions','_self')</script>";
    //header("Location: ../../checkout");
    //set_error_msg('Transaction Error.');

    die();
}


if ($status == "success") {
    $customer_name  = $_GET['customer_name'];
    $message        = $_GET['message'];
    $order_id       = $_GET['order_id'];
    $s = $_GET['data'];
    $s = str_replace('\"', '"', $s);
    $s = str_replace('"{', '{', $s);
    $s = str_replace('}"', '}', $s);
    $t = json_decode($s);

    $total          = $_GET['total'];
    $transaction_id = $_GET['transaction_id'];
    $transaction_id_arr = explode("-", $transaction_id);
    $invoice_no     = end($transaction_id_arr);
    $card           = $_GET['card'];

    $status = "Payment Complete";
    $db = new dbase;
    $db->query("INSERT INTO `billing_shipping` (`s_unique_id`, `invoice`, `b_firstname`, `b_lastname`, `b_contact`, `b_email`, `b_street`, `b_town`, `b_country`, `b_zip`) VALUES ( '$customer_id', '$invoice_no','$t->b_firstname','$t->b_lastname','$t->b_contact', '$t->b_email', '$t->b_street','$t->b_town','$t->b_country', '1868')");
    
    if ($db->execute()) {
          
                                   $email->email = "orders@linkwi.co";
                    $email->parent = "Linkwi Team";
                    $email->student = $t->b_firstname . ' ' . $t->b_lastname;
                    $email->time = $tyme;
                    $email->date = $day;
                    $email->site_title = 'Linkwi Digital Subscription';
                    $email->site_url = 'https://linkwi.co/admin';
                    $email->header = 'Linkwi Subsciption Update Notification';
                    $email->subject = 'Subscription Renewal';
                    $email->body = 'Hey team, someone just renewed their subscription. <br/><br/>Please login to the admin backend to view the details of this renewal';
                    $email->button = 'login.php';
                    $email->button_name = 'Login';
                    $email->mailMessage();

                    //send another

                    $email->email = $t->b_email;
                    $email->parent = $t->b_firstname . ' ' . $t->b_lastname;
                    $email->time = $tyme;
                    $email->date = $day;
                    $email->site_title = 'Linkwi Digital Subsciption';
                    $email->site_url = 'https://linkwi.co/LINKWI';
                    $email->header = 'Your Linkwi Subscription Renwal Was Successful';
                    $email->subject = 'Thank you for your renewal';
                    $email->body = 'Hey ' . $t->b_firstname . ', your transaction was successful. Your subscription has been renewed. <br/><br/> Thanks you, and do have a wonderful day';
                    $email->button = 'login.php';
                    $email->button_name = 'Login';
                    $email->address = $t->b_street . ', ' . $t->b_town . ', ' . $t->b_country;
                    $email->mailMessage();
                    $email = null;
                    
                }
            
            
            $db->query("SELECT * FROM subscriptions WHERE UniqueID='$customer_id'");
            $getSub = $db->fetchSingle();
            if(empty($getSub)){
            	 $db->query("INSERT INTO `subscriptions` (`UniqueID`, `Start`, `End`) VALUES ('$customer_id', '$Dateandtime', '$expDate')");
            	 $db->execute();
            	 $db->closeConnection();
            
            }else{           
             $start_date = new DateTime($getSub['Start']);
	            $end_date = new DateTime($getSub['End']);            
	            $today_date = new DateTime();
            if ($start_date <= $today_date && $today_date <= $end_date) {
	           
             //if user still active
                $tz = 'America/Port_of_Spain';
		$timestamp = strtotime($getSub['End']);
		$dtrenew = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
		$dtrenew->setTimestamp($timestamp); //adjust the object to correct timestamp
		
		// Add 1 year to the date
		$dtrenew->modify('+1 year');
		$expDate = $dtrenew->format('Y-m-d g:i:s a');
		
		$db->query('UPDATE Users SET  `AccountType` =  "1" WHERE UniqueID = "' . $customer_id . '"');
		$db->execute();

                 $db->query("UPDATE `subscriptions` SET  `End` =  '$expDate' WHERE UniqueID = '$customer_id'");
            	 $db->execute();
            	 $db->closeConnection();
             
             }else{
              //if user has expired
		$db->query('UPDATE Users SET  `AccountType` =  "1" WHERE UniqueID = "' . $customer_id. '"');
		$db->execute();
			
                $db->query("UPDATE `subscriptions` SET  `End` =  '$expDate' WHERE UniqueID = '$customer_id'");
            	 $db->execute();
            	 $db->closeConnection();
             }
          
            }
     		//echo "<script>alert('Your purchase was successful')</script>";
		//set_msg_backend('Your order was placed');
                echo "<script>window.open('../../linkwi/?my-subscriptions','_self')</script>";
                //header("Location: ../../linkwi/?subsciption");     
                    
            
        
    
}