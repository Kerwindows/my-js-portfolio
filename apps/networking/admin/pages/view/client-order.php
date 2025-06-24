<?php
//prevent external access
if (!defined('PROJECT_PATH')) {
	exit("<script>window.open('https://checkin.cyversify.com/we-see-you.php','_self')</script>");
}


display_msg();


if(!empty($_GET['invoice-no'])){
$invoice_no = $_GET['invoice-no'];
}else{
header("Location:?pending-orders");
die();
}


if (isset($_POST["submit"])) {
	
            
	    if(isset($_GET['balance'])){
	    $balance = $_GET['balance'];
	    
	    $sql_c_paid = "UPDATE customer_orders SET order_status = 'Balance Updated' WHERE invoice_no ='$invoice_no' ";
	    $sql_p_paid = "UPDATE pending_orders SET order_status = 'Balance Updated' WHERE invoice_no ='$invoice_no' ";
	    $sql_b_paid = "UPDATE payments SET paid = 'Paid' WHERE invoice_no ='$invoice_no' AND balance = '$balance' ";
		if ( ($conn->query($sql_c_paid)) AND ($conn->query($sql_p_paid)) AND ($conn->query($sql_b_paid)) ) {
			set_msg_backend('Payment Status changed');
			//echo"<script>window.open('?edit-profile','_self')</script>";
			header("location: ?confirm-order&invoice-no=$invoice_no");
		}
		else {
			echo mysqli_error($conn);
		}
	    }
	    if(isset($_GET['cancel'])){
	    
	    $sql_c_paid = "UPDATE customer_orders SET order_status = 'Pending Confirmation' WHERE invoice_no ='$invoice_no' ";
	    $sql_p_paid = "UPDATE pending_orders SET order_status = 'Pending Confirmation' WHERE invoice_no ='$invoice_no' ";
		if ( ($conn->query($sql_c_paid)) AND ($conn->query($sql_p_paid)) ) {
			set_msg_backend('Payment Status changed');
			//echo"<script>window.open('?edit-profile','_self')</script>";
			header("location: ?confirm-order&invoice-no=$invoice_no");
		}
		else {
			echo mysqli_error($conn);
		}
	    }
	    else{
	    $sql_c_paid = "UPDATE customer_orders SET order_status = 'Paid' WHERE invoice_no ='$invoice_no' ";
	    $sql_p_paid = "UPDATE pending_orders SET order_status = 'Paid' WHERE invoice_no ='$invoice_no' ";
		if ( ($conn->query($sql_c_paid)) AND ($conn->query($sql_p_paid)) ) {
			set_msg_backend('Payment Status changed');
			//echo"<script>window.open('?edit-profile','_self')</script>";
			header("location: ?confirm-order&invoice-no=$invoice_no");
		}
		else {
			echo mysqli_error($conn);
		}
	    }
		
        
	    
	
}
$sql_items = "SELECT pending_orders.order_id,pending_orders.product_id,pending_orders.invoice_no,pending_orders.pro_logo_name,pending_orders.pro_logo_image,customer_orders.qty,customer_orders.due_amount,products.product_id,products.product_title,products.product_price,products.product_psp_price,billing_shipping.s_street,billing_shipping.s_town,billing_shipping.s_country,billing_shipping.s_firstname,billing_shipping.s_lastname,billing_shipping.s_contact,billing_shipping.s_email
FROM products
INNER JOIN pending_orders ON pending_orders.product_id = products.product_id 
INNER JOIN customer_orders  ON customer_orders.order_id = pending_orders.order_id
inner JOIN billing_shipping  ON billing_shipping.invoice = pending_orders.invoice_no
WHERE pending_orders.invoice_no = '$invoice_no' 
ORDER BY pending_orders.order_id DESC";


$sql = "SELECT Users.FirstName, Users.LastName,Users.Contact,Users.EmailAddress, Users.ProfileImage,Users.Address,Users.Organization,Users.IndustryType,Users.Date,Users.Active,Users.AccountType,pending_orders.order_id,pending_orders.product_id,pending_orders.invoice_no,pending_orders.order_status AS orderstatus
FROM pending_orders
INNER JOIN Users  ON Users.UniqueID = pending_orders.customer_id
WHERE pending_orders.invoice_no = '$invoice_no' 
GROUP BY invoice_no 
ORDER BY pending_orders.order_id DESC";


$customer_result= mysqli_query($conn,$sql);
if(mysqli_num_rows($customer_result)==0){
header("Location:?pending-orders");
die();
}
$customer_row = mysqli_fetch_assoc($customer_result);
?>

<!-- Main content -->
<section class="content-header">
  <div class="container-fluid">
  
  
    <!--start of header row-->
    <div class='row mb-2'>
      <div class='col-sm-6'>
        <h1 class='m-0'>Order confirmation for</h1> 
      </div>
      <!-- /.col -->
      <div class='col-sm-6'>
        <ol class='breadcrumb float-sm-right'>
          <li class='breadcrumb-item'> <a href='/profile/<?php echo $A_Username ?>' target='_blank'>View Profile</a> </li>
          <li class='breadcrumb-item active'> <a href='?dashboard'>Dashboard</a> </li>
        </ol>
      </div>
      <!-- /.col -->
    </div>
    
    <!-- /block 1-->
    <div class="row">
      <div class="col-md-4">
      
              
            <div class='card card-purple card-outline card-widget widget-user-2'>
              <div class='card-body box-profile widget-user-header bg-default'>
                <div style="display:flex;justify-content:space-between" class="widget-user-image mt-n2">
                
                <div class="img-circle elevation-2 mb-2" style='background:url("../../../public/assets/img/<?php echo $customer_row['ProfileImage']; ?>");width:46px;height:46px;background-position: center;
    background-size: contain;'>
    </div><div>
                <!-- /.widget-user-image -->
                <h4 class="widget-user-username"><?php echo $customer_row['FirstName']; ?> <?php echo $customer_row['LastName']; ?></h4>
                
                </div>
                 
                
              </div>
              <ul class='list-group list-group-unbordered mb-3'>
              
              <li class='list-group-item'>
                    <b>Email</b> <span class='float-right'><?php echo $customer_row['EmailAddress']; ?></span>
                  </li>
                  <li class='list-group-item'>
                    <b>Contact</b> <span class='float-right'><?php echo $customer_row['Contact']; ?></span>
                  </li>
                  <li class='list-group-item'>
                    <b>Address</b> <span class='float-right'><?php echo $customer_row['Address']; ?></span>
                  </li>
                  
                  
                  </ul>
            </div>
            </div>
         </div>
         <div class="col-md-4">
      
              
            <div class='card card-purple card-outline card-widget widget-user-2'>
              <div class='card-body box-profile widget-user-header bg-default'>
                
                <!-- /.widget-user-image -->
                
             
              <h6 class="">User Information:</h6>
                <ul class='list-group list-group-unbordered mb-3'>
                <li class='list-group-item'>
                    <b>Organization</b> <span class='float-right'><?php echo $customer_row['Organization']; ?></span>
                  </li>
                  <li class='list-group-item'>
                    <b>Industry</b> <span class='float-right'><?php echo $customer_row['IndustryType']; ?></span>
                  </li>
                  <li class='list-group-item'>
                    <b>Date Registered</b> <span class='float-right'><?php echo $customer_row['Date']; ?></span>
                  </li>
                  </ul>
            </div>
            </div>
         </div>
         
         
         
         
        <div class="col-md-4">
      
              
            <div class='card card-purple card-outline card-widget widget-user-2'>
              <div class='card-body box-profile widget-user-header bg-default'>
                
                <!-- /.widget-user-image -->
                
             
              <h6 class="">Account Information:</h6>
                <ul class='list-group list-group-unbordered mb-3'>
                  <li class='list-group-item'>
                    <b>Account Type</b> <span class='float-right'><?php if(($customer_row['AccountType'] == 1)){ echo "Pro";}else{echo "Normal";} ?></span>
                  </li>
                  <li class='list-group-item'>
                    <b>Account Status</b> <span class='float-right'><?php if(($customer_row['Active'] == 1)){ echo "Active";}else{echo "Inactive";} ?></span>
                  </li>
                  </ul>
            </div>
            </div>
         </div>
         
         
         
         
      </div>   
    <div class="row mt-2"> 
            
      
             <?php 


if (count(fetchAll($sql)) > 0) {
    foreach (fetchAll($sql) as $row) {
    	
    	$invoice_no = $row['invoice_no'];
    	$FirstName = $row['FirstName'];
	$LastName = $row['LastName'];
	$Contact = $row['Contact'];
	$EmailAddress = $row['EmailAddress'];
	$Product_id = $row['product_id'];
	$OrderStatus = $row['orderstatus'];
	
	
       
        $selected1 = $selected2 = $selected3 = $selected4 = $selected5 = $selected6 =  "";
	switch ($OrderStatus) {
	  case "Payment Complete":
	    $selected1 = "selected";
	    break;
	  case "Payment Pending":
	    $selected2 = "selected";
	    break;
	  case "Payment Processing":
	    $selected3 = "selected";
	    break;
	  case "Payment On Hold":
	    $selected4 = "selected";
	    break;
	    case "Payment Cancelled";
	    $selected5 = "selected";
	    break;
	  case "Payment Refunded";
	    $selected6 = "selected";
	    break;
	  default:
	  $selected2 = "selected";
	 } 
         	
    

        print "<div class='col-md-4'> 
        <div class='card'>
              <div class='card-body box-profile'>
              <h5>Purchase Information:</h5>
         <ul class='list-group list-group-unbordered mb-3'>
                
                <li class='list-group-item'>
                  <b>Status</b> <select class='col-md-6 col-sm-8 float-right form-control select-status' name='payment_status' aria-label='Default select example' data-id4='".$row['invoice_no']."' ><option $selected1 >Payment Complete</option><option $selected2 >Payment Pending</option><option $selected3 >Payment Processing</option><option $selected4 >Payment On Hold</option><option $selected5 >Payment Cancelled</option><option $selected6 >Payment Refunded</option></select>
                   
                  </li>
                </ul>
              </div>
            </div></div>
            
            
          
            
            
           <div class='col-md-8'> 
           <div class='card'>
              <div class='card-body box-profile'>
              <h5>Order Details:</h5>
              
              ";
              if (count(fetchAll($sql_items)) > 0) {
              $i=1;
		    foreach (fetchAll($sql_items) as $row_items) {
		             
		    print "<ul class='list-group list-group-unbordered mb-3'><h5>Item $i</h5>
		    		<li class='list-group-item'>
                    		<b>Card</b> <span class='float-right'>".$row_items['product_title']."</span>
                  		</li>
		    		<li class='list-group-item'>
                    		<b>Qty</b> <span class='float-right'>".$row_items['qty']."</span>
                  		</li>
                  		<li class='list-group-item'>
                    		<b>Price</b> <span class='float-right'>$".$row_items['due_amount']."</span>
                  		</li>
                  		";
                  		
                  		if($row_items['product_title'] == "Voila Pro"){
                  		print"
                  		<ul class=''>
	                  		<li class='list-group-item'>
	                    		<b>Name on Pro Card</b> <span class='float-right'>".$row_items["pro_logo_name"]."</span>
	                  		</li>
	                  		<li class='list-group-item'>
	                    		<b>Card Image</b> <span class='float-right'><a href='../../../public/assets/pro-images/".$row_items["pro_logo_image"]."' target='_blank' download>Download File</a></span>
	                  		</li>
                  		</ul>";
                  		}else{}
                  		
                  		
                  		
                  	print"</ul>";
                  	$i++;
                  }
                  print"<h5>Delivery Address</h5><ul><li class='list-group-item'><b>Name</b><span class='float-right'>".$row_items['s_firstname']." ".$row_items['s_lastname']."</span></li>
                  		<li class='list-group-item'><b>Street</b><span class='float-right'>".$row_items['s_street']."</span></li>
                  		<li class='list-group-item'><b>Town</b><span class='float-right'>".$row_items['s_town']."</span></li>
                  		<li class='list-group-item'><b>Country</b><span class='float-right'>".$row_items['s_country']."</span></li>
                  		<li class='list-group-item'><b>Phone</b><span class='float-right'>".$row_items['s_contact']."</span></li>
                  		<li class='list-group-item'><b>Email</b><span class='float-right'>".$row_items['s_email']."</span></li></ul>";
                 }
                    
            print"   
              </div>
             
            </div></div>
	";
	
    }
}







?>  </div>
  
  <!-- /.row-->
  </div>
  <!-- /.container-fluid-->
</section>

<script>
$(document).ready(function(){  
//edit
	function edit_data(invoice_no, text, column_name)  
    {  
        $.ajax({  
            url:"includes/ajax/payment-select-edit.php",  
            method:"POST",  
            data:{invoice_no:invoice_no, text:text, column_name:column_name},  
            dataType:"text",  
            success:function(data){  
                alert("Status changed to " + text);
		//$('#result').html("<div class='alert alert-success'>"+data+"</div>");
		//toastr.success('Saved'); 
            }  
        });  
    } 
    
    
     $(document).on('change', '.select-status', function(){  
     

        var invoice_no = $(this).data("id4"); 
        var status = $(this).val(); 
        console.log(invoice_no);
        edit_data(invoice_no,status, "order_status");  
        
	});
});
</script>