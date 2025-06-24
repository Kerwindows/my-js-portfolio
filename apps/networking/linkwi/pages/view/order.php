<?php
session_start();
if (!defined('PROJECT_PATH')) {

  exit("<script>window.open('https://voiladigital.ltd/we-see-you.php','_self')</script>");
}

$host = DB_HOST;
$dbusername = DB_USER;
$dbpassword = DB_PASSWORD;
$dbname = DB_NAME;
// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()) {
  die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}



//set time zone stamp
$tz = 'America/Port_of_Spain';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string //
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$Dateandtime =  $dt->format('Y.m.d H:i:s');


include ('includes/functions/messge-alerts.php');
include FRONT_INCLUDES_PATH . '/head.php';
include FRONT_INCLUDES_PATH . '/header.php';



//$c_id comesfrom url
$customer_id = $c_id;
$customer_id = substr($c_id,24);
$customer_id = substr($customer_id,0,-24);

$order_id = $order_id;
$invoice_no = $invoice;
$ip_add = $_SESSION['ip_add'];

$status = "Payment Pending";

//$invoice comesfrom url

echo "$c_id<br/>";
echo "$customer_id<br/>";
echo "$invoice_no<br/>";
$select_cart = "SELECT * FROM cart WHERE ip_add='$ip_add'";

$run_cart = mysqli_query($conn,$select_cart);
if(mysqli_num_rows($run_cart) == '0'){header("Location: ../../checkout");}

while($row_cart = mysqli_fetch_array($run_cart)){

$pro_id = $row_cart['p_id'];


$pro_qty = $row_cart['qty'];

$pro_logo_name = $row_cart['pro_logo_name'];
$pro_logo_image = $row_cart['pro_logo_image'];

$sub_total = $row_cart['p_price']*$pro_qty;


$insert_customer_order = "INSERT INTO `customer_orders` (customer_id,order_id,due_amount,invoice_no,qty,order_date,order_status,pro_logo_name,pro_logo_image) VALUES ('$customer_id','$order_id','$sub_total','$invoice_no','$pro_qty','$Dateandtime','$status','$pro_logo_name','$pro_logo_image')";

$run_customer_order = mysqli_query($conn,$insert_customer_order);

$insert_pending_order = "INSERT INTO `pending_orders` (customer_id,order_id,invoice_no,product_id,qty,order_status,pro_logo_name,pro_logo_image) VALUES ('".stripslashes(htmlspecialchars($customer_id))."','".stripslashes(htmlspecialchars($order_id))."','".stripslashes(htmlspecialchars($invoice_no))."','".stripslashes(htmlspecialchars($pro_id))."','".stripslashes(htmlspecialchars($pro_qty))."','".stripslashes(htmlspecialchars($status))."','".stripslashes(htmlspecialchars($pro_logo_name))."','".stripslashes(htmlspecialchars($pro_logo_image))."' )";

$run_pending_order = mysqli_query($conn,$insert_pending_order);



if(($run_pending_order) And ($run_customer_order)){

$delete_cart = "DELETE FROM cart WHERE ip_add='$ip_add'";

$run_delete = mysqli_query($conn,$delete_cart);

//echo "<script>alert('Your order has been submitted,Thanks ')</script>";
set_msg_backend('Your order was placed');
//echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";
header("Location: ../../../public/?my-orders");
}


}

?>