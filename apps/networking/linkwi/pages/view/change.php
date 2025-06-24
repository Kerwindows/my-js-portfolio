<?php

require ('../../../includes/linkwi.php');
require LINKWI_FUNCTIONS_PATH . '/functions.php';

$conn = new dbase;
$ip_add = getRealUserIp();

if(isset($_POST['id'])){

$id = $_POST['id'];

$qty = $_POST['quantity'];

if($qty > 0){
$conn->query("update cart set qty='$qty' where p_id='$id' AND ip_add='$ip_add'");
$conn->execute();
}
}else{
echo"Something went wrong";

}




?>