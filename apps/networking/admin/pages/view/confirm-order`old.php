<?php
//prevent external access
if (!defined('PROJECT_PATH')) {
    exit("<script>window.open('https://checkin.cyversify.com/we-see-you.php','_self')</script>");
}


display_msg();

$db = new dbase;

if (!empty($_GET['invoice-no'])) {
    $invoice_no = $_GET['invoice-no'];
} else {
    header("Location:?pending-orders");
    die();
}


if (isset($_POST["submit"])) {


    if (isset($_GET['balance'])) {
        $balance = $_GET['balance'];


        $db->query("UPDATE customer_orders SET order_status = 'Balance Updated' WHERE invoice_no ='$invoice_no' ");
        $db->execute();
        $db->query("UPDATE pending_orders SET order_status = 'Balance Updated' WHERE invoice_no ='$invoice_no' ");
        $db->execute();
        $db->query("UPDATE payments SET paid = 'Paid' WHERE invoice_no ='$invoice_no' AND balance = '$balance' ");
        $db->execute();

        set_msg_backend('Payment Status changed');
        //echo"<script>window.open('?edit-profile','_self')</script>";
        header("location: ?confirm-order&invoice-no=$invoice_no");
    }
    if (isset($_GET['cancel'])) {


        $db->query("UPDATE customer_orders SET order_status = 'Pending Confirmation' WHERE invoice_no ='$invoice_no' ");
        $db->execute();
        $db->query("UPDATE pending_orders SET order_status = 'Pending Confirmation' WHERE invoice_no ='$invoice_no' ");
        $db->execute();

        set_msg_backend('Payment Status changed');
        //echo"<script>window.open('?edit-profile','_self')</script>";
        header("location: ?confirm-order&invoice-no=$invoice_no");
    } else {
        $db->query("UPDATE customer_orders SET order_status = 'Paid' WHERE invoice_no ='$invoice_no' ");
        $db->execute();
        $db->query("UPDATE pending_orders SET order_status = 'Paid' WHERE invoice_no ='$invoice_no' ");
        $db->execute();
        set_msg_backend('Payment Status changed');
        //echo"<script>window.open('?edit-profile','_self')</script>";
        header("location: ?confirm-order&invoice-no=$invoice_no");
    }
}





$db->query("SELECT 
billing_shipping.invoice,
billing_shipping.s_firstname,
billing_shipping.s_lastname,
billing_shipping.s_street,
billing_shipping.s_town,
billing_shipping.s_country,
billing_shipping.s_zip,
billing_shipping.s_contact,
billing_shipping.s_email,
billing_shipping.b_firstname,
billing_shipping.b_lastname,
billing_shipping.b_street,
billing_shipping.b_town,
billing_shipping.b_country,
billing_shipping.b_zip,
billing_shipping.b_contact,
billing_shipping.b_email
FROM billing_shipping 
WHERE billing_shipping.invoice = '$invoice_no'");
$shipping_row = $db->fetchSingle();

$db->query("SELECT 
customer_orders.qty,
customer_orders.due_amount,
customer_orders.pro_logo_name,
customer_orders.pro_logo_image,
customer_orders.product_title
FROM customer_orders
WHERE customer_orders.invoice_no = '$invoice_no'");
$orders = $db->fetchMultiple();



$db->query("SELECT 
pending_orders.order_id,
pending_orders.invoice_no,
pending_orders.pro_logo_name,
pending_orders.pro_logo_image,
pending_orders.order_status AS orderstatus,
Users.FirstName, 
Users.LastName,
Users.Contact,
Users.EmailAddress, 
Users.ProfileImage,
Users.Address,
Users.Organization,
Users.IndustryType,
Users.Date,
Users.Active,
Users.AccountType
FROM Users
INNER JOIN pending_orders  ON pending_orders.customer_id  = Users.UniqueID
WHERE pending_orders.invoice_no = '$invoice_no'");
$customer_result = $db->fetchCount();

if ($customer_result == 0) {
    header("Location:?pending-orders");
    die();
} else {
    $customer_row = $db->fetchSingle();
}

$db->query("SELECT 
payments.payment_date,
payments.receipt_image,
payments.amount,
payments.payment_mode,
payments.balance,
payments.code,
payments.ref_no,
payments.note
FROM payments 
WHERE payments.invoice_no = '$invoice_no'");
$payment_result = $db->fetchMultiple();





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
                    <li class='breadcrumb-item'> <a href='/profile/<?php echo $A_Username ?>' target='_blank'>View
                            Profile</a> </li>
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
                            <div class="img-circle elevation-2 mb-2" style='background:url("../linkwi/images/profile-images/<?php echo $customer_row['ProfileImage']; ?>");width:46px;height:46px;background-position: center;
    background-size: contain;'>
                            </div>
                            <div>
                                <!-- /.widget-user-image -->
                                <h4 class="widget-user-username"><?php echo $customer_row['FirstName']; ?>
                                    <?php echo $customer_row['LastName']; ?></h4>
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
                                <b>Account Type</b> <span class='float-right'><?php if (($customer_row['AccountType'] == 1)) {
                                                                                    echo "Pro";
                                                                                } else {
                                                                                    echo "Normal";
                                                                                } ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Account Status</b> <span class='float-right'><?php if (($customer_row['Active'] == 1)) {
                                                                                    echo "Active";
                                                                                } else {
                                                                                    echo "Inactive";
                                                                                } ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-2">


            <?php


            if ($customer_result > 0) {
                $Amount = $Balance = 0;

                foreach ($payment_result as $Amt) {
                    $Amount = $Amount + $Amt['amount'];
                    $Balance = $Balance + $Amt['balance'];
                }




                $invoice_no = $customer_row['invoice_no'];
                $FirstName = $customer_row['FirstName'];
                $LastName = $customer_row['LastName'];
                $Contact = $customer_row['Contact'];
                $EmailAddress = $customer_row['EmailAddress'];

                $OrderDate = $payment_result[0]['payment_date'];
                $payment_mode = $payment_result[0]['payment_mode'];
                $receipt_image = $payment_result[0]['receipt_image'];
                $Ref_No = $payment_result[0]['ref_no'];
                $Code = $payment_result[0]['code'];
                $note = $payment_result[0]['note'];
                $OrderStatus = $customer_row['orderstatus'];

                $ReadableTime = strtotime($OrderDate);
                $ReadableTime = date("D d M Y, h:i:s a", $ReadableTime);

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
                <b>Invoice No.</b>
                <span class='float-right'>$invoice_no</span>
              </li>
              <li class='list-group-item'>
                <b>Payment Date</b>
                <span class='float-right'>$ReadableTime</span>
              </li>
              <li class='list-group-item'>
                <b>Payment Mode</b>
                <span class='float-right'>$payment_mode</span>
              </li>
              <li class='list-group-item'>
                <b>Code</b>
                <span class='float-right'>$Code</span>
              </li>
              <li class='list-group-item'>
                <b>Ref No</b>
                <span class='float-right'>$Ref_No</span>
              </li>
              <li class='list-group-item'>
                <b>Amount Paid</b>
                <span class='float-right'>$ $Amount</span>
              </li>
              <li class='list-group-item'>
                <b>Balance</b>
                <span class='float-right'>$ $Balance</span>
              </li>
              <li class='list-group-item'>
                <b>Note: </b>
                <span class='float-right'>$note</span>
              </li>
              <li class='list-group-item'>
                <b>Status</b>
                <select class='col-md-6 col-sm-8 float-right form-control select-status' name='payment_status' aria-label='Default select example' data-id4='" . $customer_row['invoice_no'] . "'>
                  <option $selected1>Payment Complete</option>
                  <option $selected2>Payment Pending</option>
                  <option $selected3>Payment Processing</option>
                  <option $selected4>Payment On Hold</option>
                  <option $selected5>Payment Cancelled</option>
                  <option $selected6>Payment Refunded</option>
                </select>
              </li>
            </ul>
          </div>
        </div>
      </div>
            
            
      <div class='col-md-4'>
     
      <div class='card'>
      <div class='card-body box-profile'>
        <h5>Shipping Address</h5>
        <ul class='list-group list-group-unbordered mb-3'>
          <li class='list-group-item'>
          <bName</b>
          <span class='float-right'>" . $shipping_row['s_firstname'] . " " . $shipping_row['s_lastname'] . "</span>
          </li>
          <li class='list-group-item'>
          <b>Address</b>
          <span class='float-right'>" . $shipping_row['s_street'] . ", " . $shipping_row['s_town'] . ", " . $shipping_row['s_country'] . ", " . $shipping_row['s_zip'] . "</span>
          </li>
          <li class='list-group-item'>
          <b>Phone Contact</b>
          <span class='float-right'>" . $shipping_row['s_contact'] . "</span>
          </li>
          <li class='list-group-item'>
          <b>Email Contact</b>
          <span class='float-right'>" . $shipping_row['s_email'] . "</span>
          </li>
        </ul>
      </div>
    </div>
    <div class='card'>
      <div class='card-body box-profile'>
        <h5>Billing Address</h5>
        <ul class='list-group list-group-unbordered mb-3'>
        <li class='list-group-item'>
          <bName</b>
          <span class='float-right'>" . $shipping_row['b_firstname'] . " " . $shipping_row['b_lastname'] . "</span>
          </li>
          <li class='list-group-item'>
          <b>Address</b>
          <span class='float-right'>" . $shipping_row['b_street'] . ", " . $shipping_row['b_town'] . ", " . $shipping_row['b_country'] . ", " . $shipping_row['b_zip'] . "</span>
          </li>
          <li class='list-group-item'>
          <b>Phone Contact</b>
          <span class='float-right'>" . $shipping_row['b_contact'] . "</span>
          </li>
          <li class='list-group-item'>
          <b>Email Contact</b>
          <span class='float-right'>" . $shipping_row['b_email'] . "</span>
          </li>
        </ul>
      </div>
    </div>
    </div>
            
            
    <div class='col-md-4'>
    <div class='card'>
    
      </div>
    <div class='card'>
      <div class='card-body box-profile'>
        <h5>Order Details:</h5> ";

                if (count($orders) > 0) {
                    $i = 1;
                    foreach ($orders as $order) {
                        print " <ul class='list-group list-group-unbordered mb-3'>
          <h5>Item $i</h5>
          <li class='list-group-item'>
            <b>Card</b>
            <span class='float-right'>" . $order['product_title'] . "</span>
          </li>
          <li class='list-group-item'>
            <b>Qty</b>
            <span class='float-right'>" . $order['qty'] . "</span>
          </li>
          <li class='list-group-item'>
            <b>Price</b>
            <span class='float-right'>$" . $order['due_amount'] . "</span>
          </li> 
           <ul class=''>
            <li class='list-group-item'>
              <b>Name on Pro Card</b>
              <span class='float-right'>" . $order["pro_logo_name"] . "</span>
            </li>
            <li class='list-group-item'>
              <b>Card Image</b>
              <span class='float-right'>
                <a href='../../../images/card-images/" . $order["pro_logo_image"] . "' target='_blank' download>Download File</a>
              </span>
            </li>
          </ul>";

                        print "
        </ul>";
                        $i++;
                    }
                }
                print "
      </div>
    </div>
  </div>";
            }
            ?> </div>

        <!-- /.row-->
    </div>
    <!-- /.container-fluid-->
</section>

<script>
    $(document).ready(function() {
        //edit
        function edit_data(invoice_no, text, column_name) {
            $.ajax({
                url: "includes/ajax/payment-select-edit.php",
                method: "POST",
                data: {
                    invoice_no: invoice_no,
                    text: text,
                    column_name: column_name
                },
                dataType: "text",
                success: function(data) {
                    alert("Status changed to " + text);
                    //$('#result').html("<div class='alert alert-success'>"+data+"</div>");
                    //toastr.success('Saved'); 
                }
            });
        }

        $(document).on('change', '.select-status', function() {
            var invoice_no = $(this).data("id4");
            var status = $(this).val();
            edit_data(invoice_no, status, "order_status");

        });
    });
</script>