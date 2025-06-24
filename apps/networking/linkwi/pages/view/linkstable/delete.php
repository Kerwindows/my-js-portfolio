<?php  
include "../../../../includes/linkwi.php";
include (LINKWI_FUNCTIONS_PATH . '/custom.toasts.php');
display_msg();

	$db = new dbase;
	$db->query("DELETE FROM Link_Archive WHERE id = :id");  
	$db->bind(':id',$_POST["id"],PDO::PARAM_STR);
	$db->execute(); 
	
	echo "Deleted";
	 
 ?>