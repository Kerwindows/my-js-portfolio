<?php
if($_POST){ 
require  ('../../../includes/linkwi.php');
 
 $ip_add = $_POST['ip_add'];
 $refcode = $_POST['refcode'];
		$db = new dbase;
		$db->query("select * from cart where ip_add='$ip_add'");
		$count = $db->fetchCount();
		$run_cart = $db->fetchMultiple();
			$total = 0;
			$shipping = 45;
			foreach($run_cart as $row_cart){
			
			  $pro_qty = $row_cart['qty'];
			
			  $only_price = $row_cart['p_price'];
			  
			
			  $sub_total = $only_price * $pro_qty;
			
			  $total += $sub_total;
			
			}
			$total = $total - $refcode;
		$grand_total = $total + $shipping;
		
		
		if($total == '0'){ 
		$checkout_btn = '';
		}else{ 
                $checkout_btn = "<div><a href='checkout' class='btn btn-mod btn-round btn-large'>Proceed to Checkout <i class='fa fa-chevron-right'></i></a></div>";
		} 	
		
		echo json_encode([
		'subtotal' => '$'.$total,
		'shipping' => '$'.$shipping,
		'grandTotal' => '$'.$grand_total,
		'checkoutBtn' => $checkout_btn,
		'error' => ''
		]);
		}else{
		
		echo "why are you even here?";
		}