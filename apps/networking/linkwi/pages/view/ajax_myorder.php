<?php
//insert.php  
require "../../../includes/linkwi.php";

if(!empty($_POST))
{
$output = '';
$ID =  $_POST["userid"];  
$OID = $_POST["orderid"];
$db = new dbase;

//$db->query("SELECT * FROM customer_orders WHERE customer_id = '$ID' AND invoice_no = '$OID'");

$db->query("SELECT * FROM customer_orders INNER JOIN billing_shipping ON customer_orders.invoice_no = billing_shipping.invoice WHERE customer_orders.customer_id = '$ID' AND customer_orders.invoice_no = '$OID'");

$order = $db->fetchSingle();
//html output for updating the chart
    

      $output .= "<tr>
      		<td>{$order['pro_logo_name']}</td> 
	        <td><a href=\"../images/card-images/{$order['pro_logo_image']}\" target='_blank'><img width='72px' src=\"../images/card-images/{$order['pro_logo_image']}\"></a></td>
	      </tr>";

     


echo "<div class='table-responsive'><table class='table table-bordered table-hover'>
<th>Name on Card</th>
<th>Card Image</th>
$output
</table></div>";

$datetime_string = $order['order_date'];
$datetime = DateTime::createFromFormat('Y-m-d H:i:s', $datetime_string);
$formatted_datetime = $datetime->format('l jS F, h:i:s A');

?>
<div class="table-responsive">
  <table class="table table-bordered">
    <tbody>
      <tr>
        <td colspan="3"><img width="90px" src="http://linkwi.co/images/linkwi-og.webp" alt="Linkwi" /></td>
        <td rowspan="2" colspan="2">
          <h4 class="font-weight-bold"> INVOICE </h4>
          <p class="m-0"><b>Billed To:</b> <? echo $order['b_firstname'].' '.$order['b_lastname']; ?></p>
          <p class="m-0"><b>Address:</b> <? echo $order['b_street'].', '.$order['b_town'].' '.$order['b_country']; ?></p>  
          <p class="m-0"><b>Contact:</b> <? echo $order['b_contact']; ?></p>
          <p class="m-0"><b>Email:</b> <? echo $order['b_email']; ?></p>
        </td>
      </tr>
      <tr>
        <td>
          <p class="m-0">Shipped To: <? echo $order['s_firstname'].' '.$order['s_lastname']; ?></p>
          <p class="m-0">Address: <? echo $order['s_street'].', '.$order['s_town'].' '.$order['s_country']; ?></p>
          <p class="m-0">Contact: <? echo $order['s_contact']; ?></p>
          <p class="m-0">Emails: <? echo $order['s_email']; ?></p>
        </td>
        <td colspan="2">
          <p><b>Invoice #: </b><? echo $order['invoice_no']; ?></p>
          <p><b>Order ID: </b><? echo $order['order_id']; ?></p>
          <p><b>Date: </b><? echo $formatted_datetime ?></p>
        </td>
      </tr>
      <tr>
        <td class="font-weight-bold">Item</td>
        <td class="font-weight-bold">Duration</td>
        <td class="font-weight-bold">Qty</td class="font-weight-bold">
        <td class="font-weight-bold">Line Total</td>
        <td class="font-weight-bold">Total</td>
      </tr>
      <tr>
        <td>Linkwi Business Card</td>
        <td>Onetime</td>
        <td><?php echo $order['qty'] ?></td>
        <td>Subtotal</td>
        <td>$<?php echo $order['due_amount'] - 45 + $order['referral_discount']?></td>
      </tr>
      <tr>
        <td class="font-weight-bold" colspan="4">Shipping</td>
        <td>+$45.00</td>
      </tr>
      <tr>
        <td colspan="4" ><span class="font-weight-bold" >Referral Code Discount</span><br/><span class="badge badge-secondary"> <? echo $order['referral_id']; ?></span></td>
        <td >-$<? echo $order['referral_discount']; ?>.00</td>
      </tr>
      
      <tr>
        <td colspan="3"></td>
        <td class="font-weight-bold">Total</td>
        <td>$<? echo $order['due_amount']; ?></td>
      </tr>
      <tr>
        <td colspan="3" class="font-weight-bold">Payment Method</td>
        <td class="text-right font-weight-bold" colspan="2">Future Payments</td>
      </tr>
      <tr>
        <td colspan="3">Credit Card </td>
        <td class="text-right" colspan="2">$100.00 TTD /Yearly</td>
      </tr>
    </tbody>
  </table>
</div>

<?php }?>