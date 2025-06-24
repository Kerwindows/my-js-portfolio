<?php 
class SocialCount {

	public function getSocialMediaArray($uniqueid, $monthNum,$year) {
		$SocialMediaArray = array();
		$db = new dbase;
		$db->query("SELECT Social FROM View_Social_Stats WHERE UniqueID = :uniqueid AND MONTH(Date) = :monthNum and YEAR(Date) = :year GROUP BY Social ORDER BY Social ");
		$db->bind(':uniqueid', $uniqueid, PDO::PARAM_STR);
		$db->bind(':monthNum', $monthNum, PDO::PARAM_STR);
		$db->bind(':year', $year, PDO::PARAM_STR);
		$getRs = $db->fetchMultiple();
		foreach ($getRs as $R) {
			if ($R['Social'] != "") {
				$SocialMediaArray[] = ucfirst($R['Social']);
			}
		}

		$this->SocialMediaArray = $SocialMediaArray;
		return json_encode($SocialMediaArray);
		
		$db->closeConnection();
	}

	public function getSocialMediaCount($uniqueid, $monthNum,$year) {
		if(empty($this->SocialMediaArray)){
		$ans = json_encode([0]);
		return $ans;
		}
		else{
		$db = new dbase;

		$queryParts = array_map(function ($socialMedia, $index) {
		    return "SUM(IF(Social = '$socialMedia', 1, 0)) AS `$index`";
		}, $this->SocialMediaArray, array_keys($this->SocialMediaArray));
		
		$query = implode(", ", $queryParts);
		
		$db->query("SELECT $query FROM View_Social_Stats WHERE UniqueID = :uniqueid AND MONTH(Date) = :monthNum and YEAR(Date) = :year ORDER BY Social");
		$db->bind(':uniqueid', $uniqueid, PDO::PARAM_STR);
		$db->bind(':monthNum', $monthNum, PDO::PARAM_STR);
		$db->bind(':year', $year, PDO::PARAM_STR);
		$getRs = $db->fetchSingle();
		
		$ans = "[" . implode(",", array_map(function ($item) {
		    return "'$item'";
		}, $getRs)) . "]";
		
		return $ans;
		
		}
		$db->closeConnection();
	}
}