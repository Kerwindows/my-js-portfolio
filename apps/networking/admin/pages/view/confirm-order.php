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

$sltd1 = $sltd2 = $sltd3 = $sltd4 = $sltd5 = $sltd6 = $sltd7 = $sltd8 = $sltd9 = $sltd10 = "";

$db->query("SELECT 
    bs.*, 
    co.qty, co.due_amount, co.pro_logo_name, co.pro_logo_image, co.product_title,co.delivery_status AS deliverystatus,co.order_status AS orderstatus,co.invoice_no,
   
    u.ProfileImage,
    u.FirstName,u.Username, u.FirstName, u.LastName, u.EmailAddress, u.Contact,u.Address,u.Organization,u.IndustryType,u.Date,u.AccountType,u.Active,
    p.payment_date, p.receipt_image, p.amount, p.payment_mode, 
    p.balance, p.code, p.ref_no, p.note
FROM billing_shipping AS bs
LEFT JOIN customer_orders AS co ON bs.invoice = co.invoice_no
LEFT JOIN Users AS u ON co.customer_id = u.UniqueID
LEFT JOIN payments AS p ON bs.invoice = p.invoice_no
WHERE bs.invoice = :invoice_no;");

$db->bind(':invoice_no',$invoice_no,PDO::PARAM_STR);

$user = $db->fetchSingle();
$invoice_no = $user['invoice_no'];
$OrderDate = $user['payment_date'];
$payment_mode = $user['payment_mode'];
$receipt_image = $user['receipt_image'];
$Ref_No = $user['ref_no'];
$Code = $user['code'];
$note = $user['note'];
$OrderStatus = $user['orderstatus'];
$Deliverystatus = $user['deliverystatus'];
$Amount = $user['amount'];
$Balance = $user['balance'];

$ReadableTime = strtotime($OrderDate);
$ReadableTime = date("D d M Y, h:i:s a", $ReadableTime);

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
                    <li class='breadcrumb-item'> <a href='/profile/<?php echo $user['Username'] ?>' target='_blank'>View
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
                            <div class="img-circle elevation-2 mb-2" style='background:url("../linkwi/images/profile-images/<?php echo $user['ProfileImage']; ?>");width:46px;height:46px;background-position: center;
    background-size: contain;'>
                            </div>
                            <div>
                                <!-- /.widget-user-image -->
                                <h4 class="widget-user-username"><?php echo $user['FirstName']; ?>
                                    <?php echo $user['LastName']; ?></h4>
                            </div>
                        </div>
                        <ul class='list-group list-group-unbordered mb-3'>
                            <li class='list-group-item'>
                                <b>Email</b> <span class='float-right'><?php echo $user['EmailAddress']; ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Contact</b> <span class='float-right'><?php echo $user['Contact']; ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Address</b> <span class='float-right'><?php echo $user['Address']; ?></span>
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
                                <b>Organization</b> <span
                                    class='float-right'><?php echo $user['Organization']; ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Industry</b> <span class='float-right'><?php echo $user['IndustryType']; ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Date Registered</b> <span class='float-right'><?php echo $user['Date']; ?></span>
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
                                <b>Account Type</b> <span class='float-right'><?php if (($user['AccountType'] == 1)) {
                                                                                    echo "Pro";
                                                                                } else {
                                                                                    echo "Normal";
                                                                                } ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Account Status</b> <span class='float-right'><?php if (($user['Active'] == 1)) {
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

            <div class='col-md-4'>
                <div class='card'>
                    <div class='card-body box-profile'>
                        <h5>Purchase Information:</h5>
                        <ul class='list-group list-group-unbordered mb-3'>
                            <li class='list-group-item'>
                                <b>Invoice No.</b>
                                <span class='float-right'><?php echo $invoice_no ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Payment Date</b>
                                <span class='float-right'><?php echo $ReadableTime ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Payment Mode</b>
                                <span class='float-right'><?php echo $payment_mode ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Code</b>
                                <span class='float-right'><?php echo $Code ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Ref No</b>
                                <span class='float-right'><?php echo $Ref_No ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Amount Paid</b>
                                <span class='float-right'>$<?php echo $Amount ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Balance</b>
                                <span class='float-right'>$<?php echo $Balance ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Note: </b>
                                <span class='float-right'><?php echo $note ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Payment Status</b>
                                <select class='col-md-6 col-sm-8 float-right form-control order-status'
                                    name='payment_status' aria-label='Default select example'
                                    data-id='<?php echo $user['invoice_no'] ?>'>
                                    <option <?php echo $OrderStatus =="Payment Complete" ? 'selected' : '' ?>>Payment Complete</option>
                                    <option <?php echo $OrderStatus =="Payment Pending" ? 'selected' : '' ?>>Payment Pending</option>
                                    <option <?php echo $OrderStatus =="Payment Processing" ? 'selected' : '' ?>>Payment Processing</option>
                                    <option <?php echo $OrderStatus =="Payment On Hold" ? 'selected' : '' ?>>Payment On Hold</option>
                                    <option <?php echo $OrderStatus =="Payment Cancelled" ? 'selected' : '' ?>>Payment Cancelled</option>
                                    <option <?php echo $OrderStatus =="Payment Refunded" ? 'selected' : '' ?>>Payment Refunded</option>
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
                                <b>Name</b>
                                    <span
                                        class='float-right'><?php echo $user['s_firstname'] . " " . $user['s_lastname'] ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Address</b>
                                <span
                                    class='float-right'><?php echo $user['s_street'] . ", " . $user['s_town'] . ", " . $user['s_country'] . ", " . $user['s_zip']?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Phone Contact</b>
                                <span class='float-right'><?php echo $user['s_contact']?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Email Contact</b>
                                <span class='float-right'><?php echo $user['s_email']?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class='card'>
                    <div class='card-body box-profile'>
                        <h5>Billing Address</h5>
                        <ul class='list-group list-group-unbordered mb-3'>
                            <li class='list-group-item'>
                                <b>Name</b>
                                    <span
                                        class='float-right'><?php echo $user['b_firstname'] . " " . $user['b_lastname']?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Address</b>
                                <span
                                    class='float-right'><?php echo $user['b_street'] . ", " . $user['b_town'] . ", " . $user['b_country'] . ", " . $user['b_zip']?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Phone Contact</b>
                                <span class='float-right'><?php echo  $user['b_contact'] ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Email Contact</b>
                                <span class='float-right'><?php echo $user['b_email'] ?></span>
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
                        <h5>Order Details:</h5>
                        <ul class='list-group list-group-unbordered mb-3'>
                            <li class='list-group-item'>
                                <b>Card</b>
                                <span class='float-right'><?php echo  $user['product_title'] ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Qty</b>
                                <span class='float-right'><?php echo $user['qty'] ?></span>
                            </li>
                            <li class='list-group-item'>
                                <b>Price</b>
                                <span class='float-right'>$<?php echo $user['due_amount'] ?></span>
                            </li>
                            <ul class='mt-2 mb-2'>
                                <li class='list-group-item'>
                                    <b>Name on Pro Card</b>
                                    <span class='float-right'><?php echo $user["pro_logo_name"] ?></span>
                                </li>
                                <li class='list-group-item'>
                                    <b>Card Image</b>
                                    <span class='float-right'>
                                        <a href='../../../images/card-images/<?php echo  $user["pro_logo_image"] ?>'
                                            target='_blank' download>Download File</a>
                                    </span>
                                </li>
                            </ul>
                            <ul class='list-group list-group-unbordered mb-3'>
                                <li class='list-group-item'>
                                    <b>Order Status</b>
                                    <select class='col-md-6 col-sm-8 float-right form-control delivery-status'
                                        name='payment_status' aria-label='Default select example'
                                        data-id='<?php echo $user['invoice_no'] ?>'>
                                        <option <?php echo $OrderStatus =="Pending" ? 'selected' : '' ?>>Pending</option>
                                        <option <?php echo $OrderStatus =="Out for Delivery" ? 'selected' : '' ?>>Out for Delivery</option>
                                        <option <?php echo $OrderStatus =="Delivered" ? 'selected' : '' ?>>Delivered</option>
                                        <option <?php echo $OrderStatus =="On Hold" ? 'selected' : '' ?>>On Hold</option>
                                        <option <?php echo $OrderStatus =="Delayed" ? 'selected' : '' ?>>Delayed</option>
                                        
                                    </select>
                                </li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.row-->
    </div>
    <!-- /.container-fluid-->
</section>

<script>
$(document).ready(function() {
    //edit
    function editStatus(invoice_no, text, column_name) {
        $.ajax({
            url: "includes/ajax/order_delivery_status.php",
            method: "POST",
            data: {
                invoice_no: invoice_no,
                text: text,
                column_name: column_name
            },
            dataType: "text",
            success: function(data) {
                toastr.success("Status changed to " + text);
            }
        });
    }


    $(document).on('change', '.order-status', function() {
        var invoice_no = $(this).data("id");
        var status = $(this).val();
        editStatus(invoice_no, status, "order_status");

    });
    $(document).on('change', '.delivery-status', function() {
        var invoice_no = $(this).data("id");
        var status = $(this).val();
        editStatus(invoice_no, status, "delivery_status");

    });
});
</script>