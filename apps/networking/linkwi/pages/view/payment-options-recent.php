<?php

$customer_id = $_SESSION['UniqueID'];
$ip_add = $_SESSION['ip_add'];
$order_id = "VD" .strtoupper(bin2hex(random_bytes(5)));
$data = '{&quot;X'.$customer_id.'&quot;:&quot;X'.$order_id.'X&quot;}';
$shipping = 25;
$select_cart = "select * from cart where ip_add='$ip_add'";
		
		$run_cart = mysqli_query($conn, $select_cart);
		
		$count = mysqli_num_rows($run_cart);
		
			$total = 0;
			if($count ==0){
			header("Location: ../checkout");
			}
			while ($row_cart = mysqli_fetch_array($run_cart)) {
			
			  
			
			  $pro_qty = $row_cart['qty'];
			
			  $only_price = $row_cart['p_price'];
			  
			
			  $sub_total = $only_price * $pro_qty;
			  
			  $total += $sub_total;
			
			}$total += $shipping;
?>


<div class="box"><!-- box Starts -->
<p class="lead text-center">


<?php

/*function testfun($customer_id)
{
  
   $url = "order/voila6789RE98FOR43212345$customer_id";
   $url .= "194354HJ856VS256U56TY56L/$invoice_no";
   
   header("Location: $url");
}

if(array_key_exists('pay_offline',$_POST)){
   testfun($customer_id);
}*/

display_msg();
?>

<h4>Billing Information</h4>
<form action="https://tt.wipayfinancial.com/plugins/payments/request"
method="POST">
<div class="row  mt-3">
<input type="hidden" name="account_number" value="1234567890">
<input type="hidden" name="avs" value="0">
<input type="hidden" name="country_code" value="TT">
<input type="hidden" name="currency" value="TTD">
<input type="hidden" name="data" value="<?php echo $data ?>">
<input type="hidden" name="environment" value="sandbox">
<input type="hidden" name="fee_structure" value="merchant_absorb">

<div class="col-md-6">
	<article class="form-group">
	<label class="control-label">First Name</label>
	<input class="form-input" id="b_firstname" name="fname" value="<?php echo $_SESSION['FirstName'] ?>" placeholder="First name">
	</article>
</div>
<div class="col-md-6">
	<article class="form-group">
	<label class="control-label">Last Name</label>
	<input class="form-input"  name="lname" id="b_lastname" value="<?php echo $_SESSION['LastName'] ?>">
	</article>
</div>

<div class="col-md-6">
	<article class="form-group">
	<label class="control-label">Street Address</label>
	<input class="form-input"  name="addr1" id="b_street" value="<?php echo $_SESSION['Address'] ?>">
	</article>
</div>
<div class="col-md-6">
	<article class="form-group">
	<label class="control-label">Street Address 2</label>
	<input class="form-input"  name="addr2" id="b_street_2" value="<?php echo $_SESSION['Address'] ?>">
	</article>
</div>
<div class="col-md-6">
	<article class="form-group">
	<label class="control-label">City/ Town</label>
	<input class="form-input"  name="city" id="b_town" value="<?php echo $_SESSION['Address'] ?>">
	</article>
</div>
<div class="col-md-6">
	<article class="form-group">
	<label class="control-label">Country</label>
	<input class="form-input"  name="country" id="b_country" value="TT">
	</article>
</div>
<div class="col-md-6">
	<article class="form-group">
	<label class="control-label">Email</label>
	<input class="form-input"  name="email" id="b_email" value="<?php echo $_SESSION['EmailAddress'] ?>">
	</article>
</div>
<div class="col-md-6">
	<article class="form-group">
	<label class="control-label">Phone</label>
	<input  class="form-input" name="phone" value="<?php echo $_SESSION['Contact'] ?>">
	</article>
</div>
<input type="hidden" name="method" value="credit_card">
<input type="hidden" name="order_id" value="<?php echo $order_id ?>">
<input type="hidden" name="origin" value="Voila_Digital_App">
<input type="hidden" name="response_url" value="https://voiladigital.ltd/order/go/">
<input type="hidden" name="total" value="<?php echo $total ?>.00">
<!-- Redirect occurs after clicking Checkout -->
<div class="col-md-6">
	<article class="form-group">
	
	<input class="mt-4 button button-purple form-input" type="submit" value="Pay with WiPay">
	</article>
</div>

</div>
</form>

<!--<button class="button button-purple" onclick="payWiPay()">PAY WITH WIPAY</button>-->

<!--<script>

function payWiPay(){ 
var headers = new Headers();
headers.append('Accept', 'application/json');
var parameters = new URLSearchParams();
parameters.append('account_number', '1234567890');
parameters.append('avs', '0');
parameters.append('country_code', 'TT');
parameters.append('currency', 'TTD');
parameters.append('data', '<?php echo $data ?>');
parameters.append('environment', 'sandbox');
parameters.append('fee_structure', 'customer_pay');
parameters.append('method', 'credit_card');
parameters.append('order_id', 'oid_123-aBc');
parameters.append('origin', 'WiPay-example_app');
parameters.append('response_url',
'https://voiladigital.ltd/wipay/');
parameters.append('total', '100.00');
var options = {
method: 'POST',
headers: headers,
body: parameters,
redirect: 'follow'
};
fetch('https://tt.wipayfinancial.com/plugins/payments/request', options)
.then(response => response.text())
.then(result => {
// result in JSON format (header)
result = JSON.parse(result);
// perform redirect
window.location.href = result.url;
})
.catch(error => console.log('error', error));
}

</script>-->





</p>



</div><!-- box Ends -->

<?php include FRONT_INCLUDES_PATH . '/footer.php'; ?>


<!--<script>
$(document).ready(function() {
	$(document).on('click', '#pay_offline', function(){  
	
	var s_unique_id = "<?php echo $customer_id ?>";
	var ip_add 	= "<?php echo $ip_add ?>";
	var invoice 	= "<?php echo $invoice_no ?>";
   
   
       
        var s_firstname = $('#s_firstname').val();
        var s_lastname 	= $('#s_lastname').val();  
        var s_street 	= $('#s_street').val();  
        var s_town 	= $('#s_town').val();  
        var s_country 	= $('#s_country').val(); 
        var s_contact 	= $('#s_contact').val();
        var s_email 	= $('#s_email').val();
        
        if($('#billingcheckbox').val() == '1'){
        var b_firstname = $('#s_firstname').val();
        var b_lastname  = $('#s_lastname').val();  
        var b_street 	= $('#s_street').val();  
        var b_town 	= $('#s_town').val();  
        var b_country	= $('#s_country').val(); 
        var b_contact 	= $('#s_contact').val();
        var b_email 	= $('#s_email').val();
       }else{
       
        var b_firstname = $('#b_firstname').val();
        var b_lastname  = $('#b_lastname').val();  
        var b_street 	= $('#b_street').val();  
        var b_town 	= $('#b_town').val();  
        var b_country	= $('#b_country').val(); 
        var b_contact 	= $('#b_contact').val();
        var b_email 	= $('#b_email').val();
       }
        
        
        /*if( (org_board == '') || (affected_measure == '') || (issue == '') || (status == '') )
        {  
            //alert("All fields are required");
            toastr.error('All fields are required'); 
            return false;  
        }*/  
        $.ajax({  
            url:"frontend/views/payment-offline-insert.php",  
            method:"POST",  
            data:{ip_add:ip_add,
            s_unique_id:s_unique_id,
            invoice:invoice,
            s_firstname:s_firstname,
            s_lastname:s_lastname,
            s_street:s_street,
            s_town:s_town,
            s_country:s_country,
            s_contact:s_contact,
            s_email:s_email, 
            b_firstname:b_firstname,
            b_lastname:b_lastname,
            b_street:b_street,
            b_town:b_town,
            b_country:b_country,
            b_contact:b_contact,
            b_email:b_email }, 
            dataType:"text",  
            success:function(data)  
            {  
                
                var url2 = "order/voila6789RE98FOR43212345" + s_unique_id + "194354HJ856VS256U56TY56L/" + invoice;
               
                window.location.replace(url2);
            }  
        }) 
          
   });
});
</script>-->