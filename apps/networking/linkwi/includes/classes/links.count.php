<?php 




class LinkCount {


public function user_LinkShow($id){

$citys = array();

	$db = new dbase;
	$db->query("SELECT link_title FROM links WHERE UniqueID =:id ");
	$db->bind(':id', $id, PDO::PARAM_STR);
	$views = $db->fetchMultiple();

 	foreach($views as $city){
		if ($city['link_title'] != "") {
				$citys[] = $city['link_title'];
				
			}
			else{
			
			$citys[] = 'null';
			
			}
		
}

		$this->citys = $citys;
		return json_encode($citys);
		
		$db = NULL;



}



public function getLinkCount($id){



$count = array();

	$db = new dbase;
	$db->query("SELECT link_count FROM links WHERE UniqueID =:id ");
	$db->bind(':id', $id, PDO::PARAM_STR);
	$views = $db->fetchMultiple();

 	foreach($views as $counts){
		if ($counts['link_count'] != "") {
				$count[] = $counts['link_count'];
				
			}
			else{
			
			$count[] = 'null';
			
			}
		
}

		$this->count = $count;
		return json_encode($count);
		
		$db = NULL;

}

	


} // end of class
?>