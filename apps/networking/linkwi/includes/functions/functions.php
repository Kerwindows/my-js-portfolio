<?php
function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
 }
 
 
function items(){

$db = new dbase;

$ip_add = getRealUserIp();
$db->query("SELECT id FROM cart WHERE ip_add = '$ip_add' ");
return $db->fetchCount();
$db->closeConnection();
} 



// total_price function Starts //

function total_price(){

$db = new dbase;

$ip_add = getRealUserIp();

$total = 0;

$db->query("select * from cart where ip_add='$ip_add'");
$run_cart =  $db->fetchMultiple();

foreach($run_cart as $record){

$pro_id = $record['p_id'];

$pro_qty = $record['qty'];

$db->query("select * from products where product_id='$pro_id'");
$run_price = fetchMultiple();
foreach($run_price as $row_price){

$sub_total = $row_price['product_price']*$pro_qty;

$total += $sub_total;


}

}

echo "$" . $total;

$db=Null;
}


// total_price function Ends // 
 ?>