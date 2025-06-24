<?php display_msg(); ?>
<style>
.badge-success {
    color: #2f5e3c;
    background-color: #ccf9d2;
}
.table,th,tr,td {
    border-width: 0 !important;
}
</style>
<section class="content-header">
    <div class="container">
        <div class='row mb-2'>
            <div class='col-sm-6'>
                <h1 class='m-0'>My Orders</h1>
            </div>
            <!-- /.col -->
            <div class='col-sm-6'>
                <ol class='breadcrumb float-sm-right'>
                    <li class='breadcrumb-item'><a href='/profile/<?php echo $P_Username ?>' target='_blank'>View
                            Profile</a> </li>
                    <li class='breadcrumb-item active'><a href='?edit-profile'>Edit Profile</a> </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /block 1-->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-purple-addon card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <p class="lead"> Invoice History</p>
                           
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                       <!-- <th>Order Date</th> -->
                                        <th>Invoice No</th>
                                        <th>Paid</th>
                                      <!--  <th>Paid/Unpaid:</th> -->
                                        <th>Status</th>
                                        <th>Delivery</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $UniqueID = $infouser['UniqueID'];
                                    $db = new dbase;
                                    $db->query("SELECT 
                                    customer_orders.due_amount,
                                    customer_orders.invoice_no,
                                    customer_orders.order_date,
                                    customer_orders.order_status,
                                    customer_orders.delivery_status  
                                FROM 
                                    customer_orders 
                                WHERE 
                                    customer_id = '$UniqueID' 
                                ORDER BY 
                                    c_id DESC
                                ");
                                    $i = 0;
                                    foreach ($db->fetchMultiple() as $row_orders) {
                                        $invoice_no = $row_orders['invoice_no'];
                                        $due_amount_total = $row_orders['due_amount'];
                                        $order_date = substr($row_orders['order_date'], 0, 11);
                                        $order_status = $row_orders['order_status'];
                                        $delivery_status = $row_orders['delivery_status'];
                                        $i++;

                                        if ($order_status == 'Payment Pending') {
                                            $order_status = "Payment Pending";
                                            $confirm_payment_button = "<a href='?confirm&invoice_no=$invoice_no&amount=$due_amount_total' target='blank' class='button button-purple float-left'> Submit Payment Receipt</a>";
                                        }
                                        if (($order_status == 'Balance Confirmation') || ($order_status == 'Balance Updated')) {
                                            $confirm_payment_button = "<a href='?confirm&invoice_no=$invoice_no&amount=$due_amount_total' target='blank' class='button button-purple float-left'> Finish Payment</a>";
                                        }

                                        if ($order_status == 'Payment Processing') {
                                            $order_status = "Payment Processing";
                                            $confirm_payment_button = "<span class='badge badge-warning float-left'>Waiting on Confirmation</span>";
                                        }

                                        if ($order_status == 'Payment Complete') {
                                            $order_status = "Payment Complete";
                                            $confirm_payment_button = "<span class='badge badge-success float-left'>Success</span>";
                                        }

                                        if ($order_status == 'Payment On Hold') {
                                            $order_status = "Payment On Hold";
                                            $confirm_payment_button = "<span class='badge badge-warning float-left'>Payment On Hold</span>";
                                        }

                                        if ($order_status == 'Payment Cancelled') {
                                            $order_status = "Payment Cancelled";
                                            $confirm_payment_button = "<span class='badge badge-default float-left'>Payment Cancelled</span>";
                                        }
                                        if ($order_status == 'Payment Processing') {
                                            $order_status = "Payment Processing";
                                            $confirm_payment_button = "<span class='badge badge-info float-left'>Payment Processing</span>";
                                        }

                                        if ($order_status == 'Payment Refunded') {
                                            $order_status = "Payment Refunded";
                                            $confirm_payment_button = "<span class='badge badge-success float-left'>Payment Refunded</span>";
                                        }
                                    ?>
                                        <tr>
                                            <!-- tr Starts -->
                                            <th>
                                                <?php echo $i; ?>
                                            </th>
                                             <td>
                                                <?php echo $order_date; ?>
                                            </td>
                                            <!--<td>
                                                <?php echo $invoice_no; ?>
                                            </td>-->
                                            <td>$<?php echo $due_amount_total ?>
                                            </td> 
                                          <!--  <td>
                                                <?php echo $order_status; ?>
                                            </td>-->
                                            <td><?php echo $confirm_payment_button ?></td>
                                            <td><?php echo $delivery_status ?></td>
                                            <td><i style="cursor:pointer" class="fa fa-eye seeOrder" data-toggle="modal" data-target="#modal-lg" data-id='<?php echo $invoice_no ?>' aria-hidden="true"></i></td>

                                        </tr>
                                        <!-- tr Ends -->
                                    <?php } ?>
                                </tbody>
                                <!--- tbody Ends --->
                            </table>
                            <!-- table table-bordered table-hover Ends -->
                        </div>
                        <!-- table-responsive Ends -->
                    </div>
                    <!--row-->
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.row-->
    </div>
    <!-- /.container-->
</section>
<div class="modal fade" id="modal-lg" >
        <div class="modal-dialog modal-lg" style="max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Your Order Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id='thisorder'></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<script>
    const userid = "<?php echo $UniqueID; ?>";

    jQuery(document).ready(function($) {
        // Do something on click
        $('.seeOrder').click(function() {
            let orderid = $(this).attr('data-id')
            console.log(userid, orderid)
            $.ajax({
                url: "pages/view/ajax_myorder.php",
                method: "POST",
                data: {
                    userid: userid,
                    orderid: orderid
                },
                dataType: "text",
                success: function(data) {
                    console.log(data)
                    $('#thisorder').html(data)
                }
            });
        });
    });
</script>