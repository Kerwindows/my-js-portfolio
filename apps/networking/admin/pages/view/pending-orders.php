<?php

//set inactive
function Paid()
{
    $db = new dbase;
    $UserID = $_GET['id'];
    $db->query("UPDATE Users SET Active = '0' WHERE UserID='$UserID'");
    $db->execute();
    header("location: ?dashboard");
}
if (isset($_GET['inact'])) {
    runInactive();
}
//set active
function runActive()
{
    $db = new dbase;
    $UserID = $_GET['id'];
    $db->query("UPDATE Users SET Active = '1' WHERE UserID='$UserID'");
    $db->execute();
    header("location: ?dashboard");
}
if (isset($_GET['act'])) {
    runActive();
}

?>
<!-- Main content -->
<section class="content-header">
    <div class="container-fluid">
        <!--start of header row-->
        <div class='row mb-2'>
            <div class='col-sm-6'>
                <h1 class='m-0'>Client Orders</h1>
            </div>
            <!-- /.col -->
            <div class='col-sm-6'>
                <ol class='breadcrumb float-sm-right'>
                    <li class='breadcrumb-item'><a href='#' target='_blank'>Go To Landing Page</a> </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /block 1-->
        <div class="row">
            <div class="col-md-12">

                <!-- Profile Image -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Orders For Voila Cards</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Order Date</th>
                                    <th>Invoice</th>
                                    <th>Balance Remaining</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db = new dbase;
                                $db->query("SELECT Users.FirstName, Users.LastName, Users.Contact,  Users.EmailAddress,  customer_orders.qty, customer_orders.order_date, customer_orders.due_amount, customer_orders.invoice_no, customer_orders.delivery_status, customer_orders.order_status AS Orderstatus FROM customer_orders INNER JOIN Users ON Users.UniqueID = customer_orders.customer_id ORDER BY customer_orders.order_id DESC");
                                $countz = $db->fetchCount();
                                $pending = $db->fetchMultiple();

                                $i = 0;

                                if ($countz > 0) {
                                    foreach ($pending as $row) {

                                        $invoice_no = $row['invoice_no'];
                                        $FirstName = $row['FirstName'];
                                        $LastName = $row['LastName'];
                                        $Contact = $row['Contact'];
                                        $due_amount = $row['due_amount'];
                                        $EmailAddress = $row['EmailAddress'];
                                        $OrderDate = $row['order_date'];
                                        $DeliveryStatus = $row['delivery_status'];
                                        $Orderstatus = $row['Orderstatus'];

                                        if ($Orderstatus == "Payment Pending") {
                                            $Orderstatus = '<span class="badge badge-danger">Payment Pending</span>';
                                            $OrderComplete = "<a href='?confirm-order&invoice-no=$invoice_no' class='pt-2 pb-2 btn btn-danger' >View</a>";
                                        } elseif ($Orderstatus == "Payment Complete") {
                                            $Orderstatus = "<span class='badge badge-success'>Payment Complete</span>";
                                            $OrderComplete = "<a href='?confirm-order&invoice-no=$invoice_no' class='pt-2 pb-2 btn btn-success' >View</a>";
                                        } elseif ($Orderstatus == "Balance Confirmation") {
                                            $Orderstatus = "<span class='badge badge-danger'>Balance Confirmation</span>";
                                            $OrderComplete = "<a href='?confirm-order&invoice-no=$invoice_no' class='pt-2 pb-2 btn btn-warning' >View</a> ";
                                        } elseif ($Orderstatus == "Payment On Hold") {
                                            $Orderstatus = "<span class='badge badge-warning'>Payment On Hold</span>";
                                            $OrderComplete = "<a href='?confirm-order&invoice-no=$invoice_no' class='pt-2 pb-2 btn btn-warning' >View</a> ";
                                        } elseif ($Orderstatus == "Payment Cancelled") {
                                            $Orderstatus = "<span class='badge badge-danger'>Payment Cancelled</span>";
                                            $OrderComplete = "<a href='?confirm-order&invoice-no=$invoice_no' class='pt-2 pb-2 btn btn-danger' >View</a> ";
                                        } elseif ($Orderstatus == "Payment Refunded") {
                                            $Orderstatus = "<span class='badge badge-info'>Payment Refunded</span>";
                                            $OrderComplete = "<a href='?confirm-order&invoice-no=$invoice_no' class='pt-2 pb-2 btn btn-info' >View</a> ";
                                        } else {
                                            $Orderstatus = '<span class="badge badge-info">Payment Processing</span>';
                                            $OrderComplete = "<a href='?confirm-order&invoice-no=$invoice_no' class='pt-2 pb-2 btn btn-info' >Confirm Payment</a>";
                                        }

                                        if ($DeliveryStatus == "Pending") {
                                            $DeliveryStatus = '<span class="badge badge-danger">Pending</span>';
                                        } elseif ($DeliveryStatus == "Out for Delivery") {
                                            $DeliveryStatus = "<span class='badge badge-info'>Out for Delivery</span>";
                                        } elseif ($DeliveryStatus == "On Hold") {
                                            $DeliveryStatus = "<span class='badge badge-warning'>On Hold</span>";
                                        } elseif ($DeliveryStatus == "Delivered") {
                                            $DeliveryStatus = "<span class='badge badge-success'>Delivered</span>";
                                        } elseif ($DeliveryStatus == "Delayed") {
                                            $DeliveryStatus = "<span class='badge badge-warning'>Delayed</span>";
                                        } 

                                        //$StartTime = strtotime($StartTime);
                                        //$StartTime = date("D d M Y, h:i:s a", $StartTime);
                                        // $EndTime = strtotime($EndTime);
                                        //$EndTime = date("D d M Y, h:i:s a", $EndTime);
                                        $i += 1;
                                        print "<tr>
                                        <td>$i</td>
                                        <td>$FirstName</td>
                                        <td>$LastName</td>
                                        <td>$EmailAddress</td> 
                                        <td>$Contact</td>
                                        <td>$OrderDate</td>
                                        <td>$invoice_no</td>
                                        <td>$$due_amount</td>
                                        <td>$Orderstatus</td>
                                        <td>$DeliveryStatus</td>
                                        <td>$OrderComplete</td>                                        
                                        </tr>";
                                    }
                                }
                                ?>
                                </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.row-->
            </div>
            <!-- /.container-fluid-->
</section>