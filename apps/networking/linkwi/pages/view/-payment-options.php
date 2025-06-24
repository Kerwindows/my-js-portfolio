<?php

$customer_id = $_SESSION['Userdata']['UniqueID'];
$ip_add = $_SESSION['ip_add'];
$order_id = "VD" . strtoupper(bin2hex(random_bytes(5)));
$invoice_no = date("Ymd") . rand(111111, 999999);
$data = '{&quot;X' . $customer_id . '&quot;:&quot;X' . $order_id . 'X&quot;}';
$shipping = 45;
$conn  = new dbase;

$conn->query("select * from cart where ip_add='$ip_add'");
$count = $conn->fetchCount();

$total = 0;
if ($count == 0) {
    header("Location: ../checkout");
}
foreach ($conn->fetchMultiple() as $row_cart) {



    $pro_qty = $row_cart['qty'];

    $only_price = $row_cart['p_price'];


    $sub_total = $only_price * $pro_qty;

    $total += $sub_total;
}
$total += $shipping;



//$data = '{&quot;X'.$customer_id.'&quot;:&quot;X'.$invoice_no.'X&quot;}';
?>

<style>
.lds-ellipsis {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
}

.lds-ellipsis div {
    position: absolute;
    top: 33px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: #000;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
}

.lds-ellipsis div:nth-child(1) {
    left: 8px;
    animation: lds-ellipsis1 0.6s infinite;
}

.lds-ellipsis div:nth-child(2) {
    left: 8px;
    animation: lds-ellipsis2 0.6s infinite;
}

.lds-ellipsis div:nth-child(3) {
    left: 32px;
    animation: lds-ellipsis2 0.6s infinite;
}

.lds-ellipsis div:nth-child(4) {
    left: 56px;
    animation: lds-ellipsis3 0.6s infinite;
}

@keyframes lds-ellipsis1 {
    0% {
        transform: scale(0);
    }

    100% {
        transform: scale(1);
    }
}

@keyframes lds-ellipsis3 {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(0);
    }
}

@keyframes lds-ellipsis2 {
    0% {
        transform: translate(0, 0);
    }

    100% {
        transform: translate(24px, 0);
    }
}
</style>
<main id="main">

    <!-- Home Section -->
    <section class="page-section" id="home">
        <div class="container">
            <form method="post" name="CheckoutForm">
                <h4>Delivery Address </h4>
                <div class="row  mt-3">

                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">First Name</label>
                            <input class="form-control" id="s_firstname" type="text" type="text" name="s_firstname"
                                value="<?php echo $_SESSION['FirstName'] ?>" placeholder="First name" required>
                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Last Name</label>
                            <input class="form-control" id="s_lastname" type="text" type="text" name="s_lastname"
                                value="<?php echo $_SESSION['LastName'] ?>" placeholder="Last name" required>

                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Street Address</label>
                            <input class="form-control" id="s_street" type="text" type="text" name="s_street" value=""
                                placeholder="Street Address" required>
                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Town / City</label>
                            <input class="form-control" id="s_town" type="text" type="text" name="s_town"
                                value="<?php echo $_SESSION['Address'] ?>" placeholder="Town" required>

                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Country</label>
                            <input class="form-control" id="s_country" type="text" type="text" name="s_country"
                                value="Trinidad and Tobago" placeholder="Country" required>

                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Phone</label>
                            <input class="form-control" id="s_contact" type="text" type="text" name="s_contact"
                                value="<?php echo $_SESSION['Contact'] ?>" placeholder="Phone" required>

                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Email</label>
                            <input class="form-control" id="s_email" type="text" type="text" name="s_email"
                                value="<?php echo $_SESSION['EmailAddress'] ?>" placeholder="Email" required>

                        </article>
                    </div>
                    <div class="col-md-6">
                        <div class="row mt-3">

                            <span class="col-9"><label class="control-label">Billing same as delivery
                                    address?</label></span>
                            <span class="col-3"><input type="checkbox" id="billingcheckbox" value="1" name="b_checkbox"
                                    class="d-inline-block" checked /></span>

                        </div>
                    </div>
                </div>
                <section class="mt-3" id="billing-form">

                    <h4>Billing Address </h4>
                    <div class="row  mt-3">
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">First Name</label>
                                <input class="form-control" id="b_firstname" type="text" name="b_firstname" value=""
                                    placeholder="First name">
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Last Name</label>
                                <input class="form-control" id="b_lastname" type="text" name="b_lastname" value=""
                                    placeholder="Last name">
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Street Address</label>
                                <input class="form-control" id="b_street" type="text" name="b_street" value=""
                                    placeholder="Street Address">
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Town / City</label>
                                <input class="form-control" id="b_town" type="text" name="b_town" value=""
                                    placeholder="Town">
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Country</label>
                                <input class="form-control" id="b_country" type="text" name="b_country" value=""
                                    placeholder="Country">
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Phone</label>
                                <input class="form-control" id="b_contact" type="text" type="text" name="b_contact"
                                    value="" placeholder="Phone">
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" id="b_email" type="text" name="b_email" value=""
                                    placeholder="Email">
                            </article>
                        </div>
                    </div>




                </section><br /><br />
                <label>
                    <h5 class="">Payment Options Available</h5>
                </label>
                <div class="col-md-12  pl-0">

                    <button type="submit" class="mt-3 btn btn-mod btn-large btn-round">PAY WITH WIPAY</button>
                    <br /><br />
                    <span style='display:none' id="loading" class="loading">Please wait while we process your
                        information...</span>
                    <div style='display:none' class="lds-ellipsis loading">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>

            </form>
            <?php

            function testfun($customer_id)
            {

                $url = "order/linkw6789RE98FOR43212345$customer_id";
                $url .= "194354HJ856VS256U56TY56L/$invoice_no";

                header("Location: $url");
            }

            if (array_key_exists('pay_offline', $_POST)) {
                testfun($customer_id);
            }

            ?>

        </div>
    </section>
</main>
<script>
function show() {
    let x = document.querySelectorAll(".loading");

    Array.from(x).map((item) => {
        if (item.style.display === "none") {
            item.style.display = "block";
            document.querySelector(".loader").style.display = "block";
            document.querySelector(".page-loader").style.display = "block";
            document.querySelector(".page-loader").style.opacity = "0.6";
        } else {
            item.style.display = "none";
        }
    })

}

//hide and show
$(document).ready(function() {
    $('#billing-form').hide();
    $('#billingcheckbox').click(function() {
        var $this = $(this);
        if ($this.is(':checked')) {
            $(this).val('1');
            $('#billing-form').hide();

            document.getElementById("s_firstname").value;
            let bill = $('#billing-form input').toArray();

            bill.map((item) => {
                item.setAttribute("hidden", true);
                item.removeAttribute("required");
            })
        } else {
            $('#billing-form').show();
            $(this).val('0');
            let bill = $('#billing-form input').toArray();
            bill.map((item) => {
                item.removeAttribute("hidden");
                item.setAttribute("required", true);

            })

        }
    });
});
const checkoutForm = document.forms.CheckoutForm;
checkoutForm.addEventListener("submit", function(evt) {
    evt.preventDefault();
    payWiPay();
    show();
});

function payWiPay() {
    let s_firstname = document.getElementById("s_firstname").value;
    let s_lastname = document.getElementById("s_lastname").value;
    let s_street = document.getElementById("s_street").value;
    let s_town = document.getElementById("s_town").value;
    let s_country = document.getElementById("s_country").value;
    let s_contact = document.getElementById("s_contact").value;
    let s_email = document.getElementById("s_email").value;

    let b_firstname = document.getElementById("b_firstname").value;
    let b_lastname = document.getElementById("b_lastname").value;
    let b_street = document.getElementById("b_street").value;
    let b_town = document.getElementById("b_town").value;
    let b_country = document.getElementById("b_country").value;
    let b_contact = document.getElementById("b_contact").value;
    let b_email = document.getElementById("b_email").value;

    if (document.getElementById("billingcheckbox").value == '1') {
        b_firstname = s_firstname;
        b_lastname = s_lastname
        b_street = s_street
        b_town = s_town
        b_country = s_country
        b_contact = s_contact
        b_email = s_email
    }

    console.log({
        b_firstname,
        b_lastname,
        b_street,
        b_town,
        b_country,
        b_contact,
        b_email
    })
    const headers = new Headers();
    headers.append('Accept', 'application/json');
    var parameters = new URLSearchParams();
    parameters.append('account_number', '5845179505');
    parameters.append('avs', '0');
    parameters.append('country_code', 'TT');
    parameters.append('currency', 'TTD');
    parameters.append(
        "data",
        '{"s_firstname":"' +
        s_firstname +
        '","s_lastname":"' +
        s_lastname +
        '","s_street":"' +
        s_street +
        '","s_town":"' +
        s_town +
        '","s_country":"' +
        s_country +
        '","s_contact":"' +
        s_contact +
        '","s_email":"' +
        s_email +
        '","b_firstname":"' +
        b_firstname +
        '","b_lastname":"' +
        b_lastname +
        '","b_street":"' +
        b_street +
        '","b_town":"' +
        b_town +
        '","b_country":"' +
        b_country +
        '","b_contact":"' +
        b_contact +
        '","b_email":"' +
        b_email +
        '"}'
    );
    parameters.append('environment', 'sandbox');
    parameters.append('fee_structure', 'merchant_absorb');
    parameters.append('method', 'credit_card');
    parameters.append('order_id', '<?php echo $order_id ?>');
    parameters.append('origin', 'Linkwi_App');
    parameters.append('response_url',
        'https://linkwi.co/wipay/go/');
    parameters.append('total', '<?php echo $total ?>.00');
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
            document.querySelector("#loading").innerText = "Redirecting to payment page...";
            // perform redirect
            window.location.href = result.url;
        })
        .catch(error => console.log('error', error));
}
</script>