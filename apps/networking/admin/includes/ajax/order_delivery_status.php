<?php  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
include "../classes/db.connect.php";  

	$invoice_no = $_POST["invoice_no"];  
	$text = stripslashes(htmlspecialchars($_POST["text"]));  
	$column_name = $_POST["column_name"];  
	
	$sql = new dbase;
	$sql->query("UPDATE customer_orders  SET $column_name = :text WHERE invoice_no = :invoice_no ");  
	$sql->bind(':text',$text,PDO::PARAM_STR); 
	$sql->bind(':invoice_no',$invoice_no,PDO::PARAM_STR); 
	if($sql->execute()){
	$sql->closeConnection();
	exit();
	}
}