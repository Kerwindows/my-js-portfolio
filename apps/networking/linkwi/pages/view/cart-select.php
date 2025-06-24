<?php

require('../../../includes/linkwi.php');
$ip_add = $_POST['ip_add'];
$refcode = $_POST['refcode'];

$conn = new dbase;
$conn->query("select * from cart where ip_add='$ip_add'"); $run_cart =
$conn->fetchMultiple(); $count = $conn->fetchCount(); ?>
<p class="text-muted">
  You currently have
  <?php echo $count; ?>
  item<?php $count > 0 ? 's' : '' ?> in your cart.
</p>

<div class="table-responsive mb-4">
  <!-- table-responsive Starts -->

  <table class="table shopping-cart-table">
    <!-- table Starts -->

    <thead>
      <!-- thead Starts -->
      <tr>
        <th>Photo</th>
        <th class="shopping-cart-table-title">Product</th>
        <th>Price</th>
        <th>Qty</th>
        <th colspan=2">Total</th>
      </tr>
    </thead>
    <!-- thead Ends -->

    <tbody>
      <!-- tbody Starts -->

      <?php
      $total = 0;
      foreach ($run_cart as $row_cart) {

        $pro_id = $row_cart['p_id'];
        $p_id = $row_cart['id'];
        $pro_qty = $row_cart['qty'];
        $pro_name = $row_cart['pro_logo_name'];
        $pro_image = $row_cart['pro_logo_image'];
        $ref_id = $row_cart['ref_id'];
        $ref_discount = $row_cart['ref_discount'];


        $only_price = $row_cart['p_price'];
        $conn->query("select * from products where product_id='$pro_id'");
      $run_products = $conn->fetchMultiple(); foreach ($run_products as
      $row_products) { $product_title = $row_products['product_title'];
      $cart_image = $row_products['cart_image']; $pro_url =
      $row_products['product_url']; } $sub_total = $only_price * $pro_qty;
      $_SESSION['pro_qty'] = $pro_qty; $total += $sub_total; ?>

      <tr>
        <td>
          <a style="position: relative" href="product/linkwi-classic">
            <img
              src="images/shop/previews/<?php echo $cart_image; ?>"
              alt=""
              width="100"
            />
            <div class="cart-image">
              <img
                style="width: 45px; object-fit: contain"
                src="images/card-images/<?php echo $pro_image; ?>"
                alt=""
                width="100%"
              />
            </div>
          </a>
        </td>
        <td class="shopping-cart-table-title">
          <a style="position: relative" href="product/linkwi-classic" title=""
            ><?php echo $product_title; ?>
            Card
          </a>
          <p style="font-size: 11px" title=""><?php echo $pro_name; ?></p>
        </td>
        <td>$<?php echo $only_price; ?></td>
        <td>
          <form class="form">
            <label for="quantity" class="sr-only"> Quantity </label>
            <input
              type="number"
              name="quantity"
              id="quantity"
              class="input-sm round quantity"
              style="width: 60px"
              min="1"
              max="100"
              value="<?php echo $_SESSION['pro_qty']; ?>"
              data-product_id="<?php echo $pro_id; ?>"
            />
          </form>
        </td>
        <td id="total">$<?php echo $sub_total; ?></td>
        <td class="text-end text-nowrap">
          <a
            href="javascript:void(0)"
            title="Remove item"
            id="<?php echo $p_id ?>"
            class="btn_delete"
            ><i class="fa fa-trash"></i>
            <span class="sr-only">Remove item</span></a
          >
        </td>
      </tr>

      <!-- tr Ends -->

      <?php }  ?>
    </tbody>
    <!-- tbody Ends -->

    <tfoot>
      <!-- tfoot Starts -->

      <tr>
        <th colspan="5">Total</th>
        <th id="cartTotal" colspan="2" class="align-right">$<?php echo $total ?>.00</th>
      </tr>
      <tr><td colspan="5"><div class="mb-20 mt-20">


        <?php if ($total == '0') {
        } else { ?>
         
            <form id="referal" class="form text-nowrap">
              <label for="coupon-code" class="sr-only">Referral-code</label>
              <input
                type="text"
                name="coupon-code"
                value="<?php echo $ref_id ?>"
                id="referral-code"
                class="input-sm round"
                placeholder="Enter code"
                style="width: 200px"
                pattern=".{3,100}"
                required
              />
              &nbsp;
		<button type="submit" class="<?php echo $ref_id == '' ? '' : 'hidden' ?> btn btn-mod btn-round btn-gray btn-small" >Apply Referral Code</button>
		<button id="ref-removal" type="button" class="<?php echo $ref_id != '' ? '' : 'hidden' ?> btn btn-mod btn-round btn-gray btn-small" >Remove Referral Code</button>
            </form>
     
        <?php } ?>
        </div></td>
        <td class="align-right">-$ <?php echo $ref_discount ?>.00</tr></tr>
    </tfoot>
    <!-- tfoot Ends -->
  </table>
  <!-- table Ends -->
</div>
<!-- table-responsive Ends -->

<div class="box-footer">
  <!-- box-footer Starts -->

  <div class="pull-left">
    <!-- pull-left Starts -->
  </div>
  <!-- pull-left Ends -->

  <div class="pull-right">
    <!-- pull-right Starts -->
    
  </div>
  <!-- pull-right Ends -->
</div>
<!-- box-footer Ends -->

<script>
  total = "<?php echo $total ?>";
  if (total === "0") {
    window.open("product/linkwi-classic", "_self");
  }
  $(document).on("click", ".btn_delete", function () {
    var id = $(this).attr("id");
    if (confirm("Are you sure?")) {
      $.ajax({
        url: "/linkwi/pages/view/cart-select-ajax.php",
        method: "POST",
        data: {
          id: id,
        },
        dataType: "text",
        success: function (data) {
          location.reload(true);
        },
      });
    }
  });

</script>