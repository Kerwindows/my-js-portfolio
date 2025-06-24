<?php
session_start();

if (!defined('PROJECT_PATH')) {

    exit("<script>window.open('https://linkwi.co/we-see-you.php','_self')</script>");
}

if (!isset($_SESSION['UniqueID'])) {
    $_SESSION['FirstName'] = "";
    $_SESSION['LastName'] = "";
    $_SESSION['Address'] = "";
    $_SESSION['Contact'] = "";
    $_SESSION['EmailAddress'] = "";
}

// Create connection
$conn = new dbase;
require LINKWI_FUNCTIONS_PATH . '/functions.php';
include LINKWI_INCLUDES_PATH . '/linkwi.shop.head.php';
$ip_add = $_SESSION['ip_add'] = getRealUserIp();

$conn = new dbase;
$conn->query("SELECT ref_id FROM cart WHERE ip_add = :ip_add");
$conn->bind(':ip_add',$ip_add,PDO::PARAM_STR);
$ref = $conn->fetchSingle();
$conn->closeConnection();
?>

<main id="main">
  <!-- Home Section -->
  <section class="page-section" id="home">
    <div class="container relative text-center">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <h2 class="hs-line-7 mb-0 wow fadeInUpShort" data-wow-delay=".2s">
            Shopping Cart
          </h2>
        </div>
      </div>
    </div>
  </section>
  <!-- End Home Section -->

  <!-- Section -->
  <section class="page-section pt-0">
    <div class="container relative">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div id="checkout-table"></div>

         <h2 class="h3">Calculate Shipping</h2>
          <div class="row">
            <div class="col-sm-6">
              <form action="#" class="form">
                <div class="mb-10">
                  <label for="shipping-country">Country</label>
                  <select
                    id="shipping-country"
                    class="input-md round form-control"
                  >
                    <option>Select Country</option>
                    <option selected>Trinidad and Tobago</option>
                  </select>
                </div>

                <!-- <div class="mb-10">
                                    <label for="shipping-state">State</label>
                                    <input id="shipping-state" placeholder="State" class="input-md round form-control"
                                        type="text" pattern=".{3,100}" />
                                </div> -->

                <!-- <div class="mb-10">
                                    <label for="shipping-postcode">Postcode / Zip</label>
                                    <input id="shipping-postcode" placeholder="Postcode / Zip"
                                        class="input-md round form-control" type="text" pattern=".{3,100}" />
                                </div> -->
              </form>
            </div>
            <div class="col-sm-6 text-end">
              <div>Cart subtotal: <strong id="subtotal"></strong></div>

             <div class="mb-10">
                Shipping: <strong id="shipping"> </strong>
              </div>

              <div class="lead mt-0 mb-30">
                Order Total: <strong id="orderTotal"> </strong>
              </div>

              <div id="checkoutBtn">
                <a href="" class="btn btn-mod btn-round btn-large"
                  >Proceed to Checkout</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Section -->
</main>

<?php include LINKWI_INCLUDES_PATH . '/linkwi.shop.footer.php'; ?>
<!---script for quantity change--->
<script>
  $(document).ready(function(data) {
let rfrlc = "<? echo $ref['ref_id'] ?>";
console.log(rfrlc);


      $(document).on('change', '.quantity', function() {
          let id = $(this).data("product_id");
          let quantity = $(this).val();
          if (isNaN(quantity)) {
              alert("Please enter a numerical quantity");
              <?php // set_error_msg("Please enter a number");
                  ?>
              location.reload();
          }
          if (quantity < 1) {
              alert("Please enter a value greater than 0");
              <?php // set_error_msg("Please enter a value greater than 0");
                  ?>
              //$(this).val('1');
              location.reload();
          }
          if ((quantity != '') && (quantity > 0)) {
              $.ajax({
                  url: "linkwi/pages/view/change.php",
                  method: "POST",
                  data: {
                      id: id,
                      quantity: quantity
                  },

                  success: function(data) {
                      <?php // set_msg("Product updated");
                          ?>
                      //alert('Quantity updated');
                      
                      fetch_ref_data(rfrlc);
                  }

              });


          }

      });
//referral code submit
      $(document).on('submit', '#referal', function(e) {
      e.preventDefault();
       rfrlc = $("#referral-code").val();
       fetch_ref_data(rfrlc);
      });
      
      $(document).on('click', '#ref-removal', function(e) {
      e.preventDefault();
      $.ajax({
              url: "linkwi/pages/view/referrals.php",
              method: "POST",
              data: {
                  refcode_removal: true
              },
              dataType: "text",
              success: function(data) {
              console.log(data)
               //location.reload();
               fetch_cart_data(0);
                  fetch_total(0);
              }
          });
      
      
      });
      
      function fetch_ref_data(refcode='') {

          $.ajax({
              url: "linkwi/pages/view/referrals.php",
              method: "POST",
              data: {
                  refcode: refcode
              },
              dataType: "text",
              success: function(data) {              
                  let res = JSON.parse(data);                
                  console.error(res.error)
                  fetch_cart_data(res.refcode);
                  fetch_total(res.refcode);
              }
          });
      }

      //function for pulling chart data from KPIs tables
      function fetch_cart_data(refcode) {
          var ip_add = '<?php echo $ip_add ?>';


          $.ajax({
              url: "linkwi/pages/view/cart-select.php",
              method: "POST",
              data: {
                  ip_add: ip_add,refcode:refcode
              },
              dataType: "text",
              success: function(data) {
                  $('#checkout-table').html(data);

              }
          });
      }
      //fetch_cart_data(rfrlc);

      function fetch_total(refcode) {
          var ip_add = '<?php echo $ip_add ?>';
          $.ajax({
              url: "linkwi/pages/view/cart-table-select.php",
              method: "POST",
              data: {
                  ip_add: ip_add,refcode:refcode
              },
              dataType: "text",
              success: function(data) {
                  let checkout = JSON.parse(data);
                  if (checkout.error != '') {
                      return false;
                  } else {
                      $('#subtotal').text(checkout.subtotal);
                      $('#shipping').text(checkout.shipping);
                      $('#orderTotal').text(checkout.grandTotal);
                      $('#checkoutBtn').html(checkout.checkoutBtn);
                  }

              }
          });
      }
      //fetch_total(rfrlc);
fetch_ref_data(rfrlc)
  });
</script>