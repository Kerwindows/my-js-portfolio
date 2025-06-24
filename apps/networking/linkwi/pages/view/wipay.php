<?php
session_start();

$customer_id = $_SESSION['UniqueID'];
$ip_add = $_SESSION['ip_add'];

//$w_id comesfrom url
//echo $w_id;


$transaction_id = $_GET['transaction_id'];
if (empty($transaction_id)) {
  header("Location: ../../checkout");
  die;
}
$customer_name = $_GET['customer_name'];

$message = $_GET['message'];

$order_id = $_GET['order_id'];

$status = $_GET['status'];

$total = $_GET['total'];

$card = $_GET['card'];

$customer_address = $_GET['customer_address'];

$customer_email = $_GET['customer_email'];

$customer_phone = $_GET['customer_phone'];

$url = $_GET['data'];



?>


<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>

<body>
    <hr />
    <script>
    var url = '<?php echo $url ?>';
    var userid = url.split('\"')[2];
    var invoice = url.split('\"')[4];
    var transaction = '<?php echo $transaction_id ?>';
    var transaction_id = transaction.split('-')[6];
    var customer_name = "<?php echo $customer_name  ?>";
    let s_firstname = customer_name.split(' ')[0];
    let s_lastname = customer_name.split(' ')[1];

    var s_unique_id = "<?php echo $customer_id ?>";
    var ip_add = "<?php echo $ip_add ?>";
    var s_street = "<?php echo $customer_address ?>";
    var s_town = "<?php echo $customer_address ?>";
    var s_country = "<?php echo $customer_address ?>";
    var s_contact = "<?php echo $customer_phone ?>";
    var s_email = "<?php echo $customer_email ?>"


    var b_firstname = s_firstname;
    var b_lastname = s_lastname;
    var b_street = "<?php echo $customer_address ?>";
    var b_town = "<?php echo $customer_address ?>";
    var b_country = "<?php echo $customer_address ?>";
    var b_contact = "<?php echo $customer_phone ?>";
    var b_email = "<?php echo $customer_email ?>"


    $.ajax({
        url: "./payment-wipay-insert.php",
        method: "POST",
        cache: false,
        data: {
            ip_add: ip_add,
            s_unique_id: s_unique_id,
            invoice: invoice,
            s_firstname: s_firstname,
            s_lastname: s_lastname,
            s_street: s_street,
            s_town: s_town,
            s_country: s_country,
            s_contact: s_contact,
            s_email: s_email,
            b_firstname: b_firstname,
            b_lastname: b_lastname,
            b_street: b_street,
            b_town: b_town,
            b_country: b_country,
            b_contact: b_contact,
            b_email: b_email
        },
        dataType: "text",
        success: function(data) {
            console.log("data", data);
            // var url2 = "order/voila6789RE98FOR43212345" + s_unique_id + "194354HJ856VS256U56TY56L/" + invoice;
            //window.location.replace(url2);
        }
    });
    </script>
</body>

</html>