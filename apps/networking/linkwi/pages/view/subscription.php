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
                <h1 id="page-title" class='m-0'>Subscription</h1>
            </div>
            <!-- /.col -->
            <div class='col-sm-6'>
                <ol class='breadcrumb float-sm-right'>
                    <li class='breadcrumb-item'><a href='?dashboard' target='_blank'>View
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
$UniqueID = $infouser['UniqueID'];

$db = new dbase;
$db->query("SELECT * FROM subscriptions WHERE UniqueID = '$UniqueID'");
$getSub = $db->fetchSingle();
if (!empty($getSub)) {
    $start = $getSub['Start'];
    $end = $getSub['End'];
    $start_date = new DateTime($start);
    $end_date = new DateTime($end);
    $today_date = new DateTime();

    $purchase_date = $start_date->format('M jS, Y');
    $next_billing_date = $end_date->format('M jS, Y');

    //$button = '<button onClick="window.location.href = \'wipay-renew/go/{invoice}\'" class="btn btn-sm btn-primary float-right">Renew</button>';
    $button = '<a href = "../renew-subscription/'.$UniqueID.'" class="btn btn-sm btn-primary float-right">Renew</a>';

    if ($start_date <= $today_date && $today_date <= $end_date) {
        $status = '<span class="badge badge-success float-left">Active</span>';
    } else {
        $status = "<span class='badge badge-danger float-left'>Expired</span>";
    }
} else {
    $status = "<span class='badge badge-success float-left'>No subscriptions</span>";
    $button = "<button onClick='window.location.href = \"https://linkwi.co/product/linkwi-business\"' class='btn btn-sm btn-primary float-right'>Get Started</button>";
    $purchase_date = $next_billing_date = '-';
}
?>

                                        <tr>
                                            <!-- tr Starts -->
                                           <td colspan="2">Start Date: </td>
                                             <td>
                                                <?php echo $purchase_date;  ?>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td colspan="2">Next Billing Date: </td>
                                            <td>
                                                <?php  echo $next_billing_date; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                            <td colspan="2">Status: </td>
                                            <td>
                                                <?php echo $status  ?>
                                            </td>
                                            <tr>
                                            <td colspan="3"><?php echo  $button ?></td>
                                            </tr>

                                        </tr>
                                        <!-- tr Ends -->
                                 
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



<script>
    /*const userid = "<?php echo $UniqueID; ?>";

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
    });*/
</script>