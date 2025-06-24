<?php
ob_start();
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
$shipping = 45;

//include ('includes/functions/messge-alerts.php');
require LINKWI_FUNCTIONS_PATH . '/functions.php';
include LINKWI_INCLUDES_PATH . '/linkwi.shop.head.php';
include LINKWI_CLASSES_PATH . '/send.Email.php';
//include LINKWI_INCLUDES_PATH . '/head.php';
//include LINKWI_INCLUDES_PATH . '/header.php';
$email = new sendMessage;

$customer_id = $_SESSION['Userdata']['UniqueID'];
$ip_add = $_SESSION['ip_add'];

//$w_id comesfrom url
//echo $w_id;

$status  = $_GET['status'];

//$invoice comesfrom url

$db = new dbase;
$db->query("SELECT * FROM cart WHERE ip_add='$ip_add'");
$runCart = $db->fetchMultiple();
if ($db->fetchCount() == 0) {
    echo "<script>alert('Cart is empty')</script>";
    echo "<script>window.open('../../checkout','_self')</script>";
    //header("Location: ../../checkout");
    die();
}
if ($status == "failed") {
    //set_error_msg('Transaction Failed. Please contact support');
    echo "<script>alert('Transaction Failed.')</script>";
    echo "<script>window.open('../../checkout','_self')</script>";
    //header("Location: ../../checkout");
    die();
}
if ($status == "error") {
    echo "<script>alert('Transaction Error')</script>";
    echo "<script>window.open('../../checkout','_self')</script>";
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

    $total          = $_GET['total'] - $t->ref_discount;
    $transaction_id = $_GET['transaction_id'];
    $transaction_id_arr = explode("-", $transaction_id);
    $invoice_no     = end($transaction_id_arr);
    $card           = $_GET['card'];

    $status = "Payment Complete";
    $db->query("INSERT INTO `billing_shipping` (`ip_add`, `s_unique_id`, `invoice`, `s_firstname`, `s_lastname`, `s_contact`, `s_email`, `s_street`, `s_town`, `s_country`, `s_zip`, `b_firstname`, `b_lastname`, `b_contact`, `b_email`, `b_street`, `b_town`, `b_country`, `b_zip`) VALUES ('$ip_add', '$customer_id', '$invoice_no','$t->s_firstname','$t->s_lastname','$t->s_contact', '$t->s_email', '$t->s_street','$t->s_town','$t->s_country', '1868','$t->b_firstname','$t->b_lastname','$t->b_contact', '$t->b_email', '$t->b_street','$t->b_town','$t->b_country', '1868')");
    
    if ($db->execute()) {
        $db->query("UPDATE Users SET AccountType = '1' WHERE UniqueID = '$customer_id'");
            foreach ($runCart as $row_cart) {
                $pro_id         = $row_cart['p_id'];
                $pro_qty        = $row_cart['qty'];
                $pro_logo_name  = $row_cart['pro_logo_name'];
                $pro_logo_image = $row_cart['pro_logo_image'];
                $ref_cart = $row_cart['ref_id'];
                $ref_discount = $row_cart['ref_discount'];

                $sub_total      = $row_cart['p_price'] * $pro_qty + $shipping - $ref_discount;

                $db->query("SELECT product_title FROM `products` WHERE product_id = '$pro_id '");
                $product_title = $db->fetchSingle();

                $db->query("INSERT INTO `customer_orders` (order_id,customer_id,due_amount,invoice_no,qty,order_date,order_status,pro_logo_name,pro_logo_image,product_title,referral_id,referral_discount) VALUES ('$order_id','$customer_id','$sub_total','$invoice_no','$pro_qty','$Dateandtime','$status','$pro_logo_name','$pro_logo_image','{$product_title['product_title']}','$ref_cart','$ref_discount')");
                $db->execute();
                $run_pending_order = true;

                $db->query("INSERT INTO `pending_orders` (order_id,customer_id,invoice_no,product_id,qty,order_status,pro_logo_name,pro_logo_image) 
  VALUES ('$order_id','" . stripslashes(htmlspecialchars($customer_id)) . "','" . stripslashes(htmlspecialchars($invoice_no)) . "','" . stripslashes(htmlspecialchars($pro_id)) . "','" . stripslashes(htmlspecialchars($pro_qty)) . "','" . stripslashes(htmlspecialchars($status)) . "','" . stripslashes(htmlspecialchars($pro_logo_name)) . "','" . stripslashes(htmlspecialchars($pro_logo_image)) . "' )");
                $db->execute();
                $run_customer_order = true;

                $db->query("INSERT INTO payments (order_id,invoice_no,card,amount,payment_mode,ref_no,payment_date,due_amount,shipping) VALUES ('$order_id','$invoice_no','$card','$sub_total','WiPay','$transaction_id','$Dateandtime','$sub_total','$shipping')");
                $db->execute();
                $run_insert_payment = true;
                if (($run_pending_order) and ($run_customer_order) and ($run_insert_payment)) {

                    $db->query("DELETE FROM cart WHERE ip_add=:ip_add");
                    $db->bind(':ip_add',$ip_add,PDO::PARAM_STR);
                    $db->execute();


                    $email->email = "orders@linkwi.co";
                    $email->parent = "Linkwi Team";
                    $email->student = $t->s_firstname . ' ' . $t->s_lastname;
                    $email->time = $tyme;
                    $email->date = $day;
                    $email->site_title = 'Linkwi Digital Business Cards';
                    $email->site_url = 'https://linkwi.co/admin';
                    $email->header = 'Linkwi Purchase Notification';
                    $email->subject = 'New Linkwi Purchase!';
                    $email->body = 'Hey team, someone just purchased a new linkwi card. <br/><br/>Please login to the admin backend to view the details of this purchase.';
                    $email->button = 'login.php';
                    $email->button_name = 'Login';
                    $email->mailMessage();

                    //send another

                    $email->email = $t->s_email;
                    $email->parent = $t->s_firstname . ' ' . $t->s_lastname;
                    $email->time = $tyme;
                    $email->date = $day;
                    $email->site_title = 'Linkwi Digital Business Cards';
                    $email->site_url = 'https://linkwi.co/LINKWI';
                    $email->header = 'Your Linkwi Purchase Was Successful';
                    $email->subject = 'Thank you for your pruchase';
                    $email->body = 'Hey ' . $t->s_firstname . ', your transaction was successful. You are now offically a Linkwi card holder. <br/><br/> Please give us 2 to 5 days to process and ship your order. <br/><br/> If you have any questions or concerns, you can email us at support@linkwi.co. Thanks again, and do have a wonderful day';
                    $email->button = 'login.php';
                    $email->button_name = 'Login';
                    $email->address = $t->s_street . ', ' . $t->s_town . ', ' . $t->s_country;
                    $email->mailMessage();
                    $email = null;
                    
                }
            }
            
            $db->query("SELECT UniqueID FROM subscriptions WHERE UniqueID='$customer_id'");
            $getSub = $db->fetchSingle();
            if(empty($getSub)){
            	 $db->query("INSERT INTO `subscriptions` (`UniqueID`, `Start`, `End`) VALUES ('$customer_id', '$Dateandtime', '$expDate')");
            	 $db->execute();
            	 $db->closeConnection();
            
            }else{
                $db->closeConnection();
            }
     
                        unset($_SESSION['EmailAddress']);
                        unset($_SESSION['FirstName']);
                        unset($_SESSION['LastName']);
                        unset($_SESSION['Contact']);
                        unset($_SESSION['Address']);
                        unset($_SESSION['City']);

                        //echo "<script>alert('Your purchase was successful')</script>";

                        //set_msg_backend('Your order was placed');
                        echo "<script>window.open('../../linkwi/?my-orders','_self')</script>";
                        //header("Location: ../../linkwi/?my-orders");     
                    
            
        
    }
}