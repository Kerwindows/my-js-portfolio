<div class="box"><!-- box Starts -->

<?php

$session_uniqueid = $_SESSION['UniqueID'];

$select_customer = "select * from Users where UniqueID='$session_uniqueid'";

$run_customer = mysqli_query($conn,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['UniqueID'];


?>

<h5 class="text-center">Payment Options For You</h5>

<p class="lead text-center">
<center>
<form method="post">
    <input class="btn btn-primary" type="submit" name="pay_offline" id="pay_offline" value="PAY OFFLINE" /><br/>
</form>
</center>
<?php

function testfun($customer_id)
{
  
   $url = "order/VOILA6789RE98FOR43212345$customer_id";
   $url .= "194354HJ856VS256U56TY56L";
   header("Location: $url");
}

if(array_key_exists('pay_offline',$_POST)){
   testfun($customer_id);
}

?>

</p>

<center><!-- center Starts -->

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"><!-- form Starts -->


<input type="hidden" name="business" value="sales@kerjemtec.com">

<input type="hidden" name="cmd" value="_cart">

<input type="hidden" name="upload" value="1">

<input type="hidden" name="currency_code" value="USD">

<input type="hidden" name="return" value="paypal_order.php?c_id=<?php echo $customer_id; ?>">


<input type="hidden" name="cancel_return" value="index.php">


<?php

$i = 0;


$ip_add = getRealUserIp();

$get_cart = "select * from cart where ip_add='$ip_add'";

$run_cart = mysqli_query($conn,$get_cart);

while($row_cart = mysqli_fetch_array($run_cart)){

$pro_id = $row_cart['p_id'];

$pro_qty = $row_cart['qty'];

$pro_price = $row_cart['p_price'];

$get_products = "select * from products where product_id='$pro_id'";

$run_products = mysqli_query($conn,$get_products);

$row_products = mysqli_fetch_array($run_products);

$product_title = $row_products['product_title'];

$i++;

?>


<input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $product_title; ?>" >

<input type="hidden" name="item_number_<?php echo $i; ?>" value="<?php echo $i; ?>" >

<input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $pro_price; ?>" >

<input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $pro_qty; ?>" >


<?php } ?>

<input class="btn btn-warning" type="image" name="submit" width="280" height="auto" src="images/paypal.png" >


</form><!-- form Ends -->

</center><!-- center Ends -->

</div><!-- box Ends -->