<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require('../../../../../includes/linkwi.php');
// Get the new order from the AJAX request
$order = $_POST['order'];
$sql = new dbase;
// Loop through the new order and update the database
foreach ($order as $index => $id) {
    $sql->query("UPDATE links SET link_position = $index WHERE id = :id");
    $sql->bind('$id',$id,PDO::PARAM_STR);
    $sql->execute();    
}
$sql->closeConnection();
echo "Order updated successfully";
}