<?php
if ($_POST) {
    require('../../../includes/linkwi.php');
require LINKWI_FUNCTIONS_PATH . '/functions.php';
$ip_add = getRealUserIp();

    $conn = new dbase;
    if (isset($_POST['refcode'])) {
        $conn->query("SELECT ref_discount,ref_code FROM referrals WHERE ref_code = :refcode");
        $conn->bind(':refcode', $_POST['refcode'], PDO::PARAM_STR);
        $res = $conn->fetchSingle();
        if($res && $_POST['refcode'] > 0){
        $conn->query("UPDATE cart SET ref_id=:ref_id,ref_discount = :ref_discount WHERE ip_add='$ip_add'");
        $conn->bind(':ref_id', $res['ref_code'], PDO::PARAM_STR);
        $conn->bind(':ref_discount', $res['ref_discount'], PDO::PARAM_STR);
        $conn->execute();    
        }    
        $conn->closeConnection();
        if ($res) {
            echo json_encode(["refcode" => $res['ref_discount'],"error" => ""]);
        } else {
            echo json_encode(["refcode" => "0", "error" => "Cannot find referral code"]);
        }
    }
    
    if (isset($_POST['refcode_removal'])) {
        $conn->query("UPDATE cart SET ref_id=:ref_id,ref_discount = :ref_discount WHERE ip_add='$ip_add'");
	$conn->bind(':ref_id', '', PDO::PARAM_STR);
        $conn->bind(':ref_discount', '', PDO::PARAM_STR);
       
      
        if ( $conn->execute()) {
            echo json_encode(["refcode" => 0,"error" => ""]);
        } else {
            echo json_encode(["refcode" => 0, "error" => "Cannot find referral code"]);
        }
          $conn->closeConnection();
    } 
} else {
    echo "are you lost?";
}