<?php

function uservisit($id)
{

	if (!isset($_COOKIE['visit'])) {
		setCookie('visit', 'yes', time() + (60 * 60 * 24 * 30));
		$db = new dbase;
		$db->query("UPDATE Views SET total_count = total_count+1 WHERE UniqueID =:id");
		$db->bind(':id', $id, PDO::PARAM_STR);
		$db->execute();

		$user_ip = getenv('REMOTE_ADDR');
		$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
		$country = $geo["geoplugin_countryName"];
		$city = $geo["geoplugin_city"];
		$date = date("Y-m-d");

		$db->query("INSERT INTO View_Stat (UniqueID,Country,Date) VALUES (:id,:country,:date)");
		$db->bind(':id', $id, PDO::PARAM_STR);
		$db->bind(':country', $country, PDO::PARAM_STR);
		$db->bind(':date', $date, PDO::PARAM_STR);
		$db->execute();
	}
}

function uservisit_count($id)
{
	$db = new dbase;
	$db->query("SELECT * FROM Views WHERE UniqueID =:id");
	$db->bind(':id', $id, PDO::PARAM_STR);

	$views = $db->fetchSingle();
	if (empty($views)) {
		echo 0;
	} else {
		echo $views['total_count'];
	}
}

function uservisit_counts($id)
{
	$db = new dbase;
	$db->query("SELECT * FROM View_Stat WHERE UniqueID =:id");
	$db->bind(':id', $id, PDO::PARAM_STR);

	$views = $db->fetchCount();
	if (empty($views)) {
		echo 0;
	} else {
		echo $views;
	}
}

class CitysCount
{
	public function user_CountryShow($id)
	{
		$citys = array();
		$db = new dbase;
		$db->query("SELECT Country FROM View_Stat WHERE UniqueID =:id  GROUP BY Country");
		$db->bind(':id', $id, PDO::PARAM_STR);
		$views = $db->fetchMultiple();
		if (empty($views)) {
			$this->citys = [""];
			return [""];
		} else {
			foreach ($views as $city) {
				if ($city['Country'] != "") {
					$citys[] = $city['Country'];
				} else {
					$citys[] = 'null';
				}
			}

			$this->citys = $citys;
			return json_encode($citys);
		}

		// $db->query("SELECT Country FROM View_Stat WHERE UniqueID =:id AND Country IS NOT NULL");
		// $db->bind(':id', $id, PDO::PARAM_STR);
		// $viewcount = $db->fetchCount();
		// if ($viewcount > 0) {
		// 	$db->query("DELETE FROM View_Stat WHERE UniqueID =:id AND Country IS NULL");
		// 	$db->bind(':id', $id, PDO::PARAM_STR);
		// 	$db->execute();
		// }
		$db = NULL;
	}


	public function getCountryCount($id)
	{

		$db = new dbase;

		$query = '';
		$ans = '';
		for ($x = 0; $x < count($this->citys); $x++) {

			if ($x == (count($this->citys) - 1)) {
				$comma = "";
			} else {
				$comma = ",";
			}

			$query .= "SUM(if(Country = '" . $this->citys[$x] . "', 1, 0)) AS `" . $x . "`$comma";
		}

		//echo $query;
		$db->query("SELECT $query FROM View_Stat WHERE UniqueID =:id ORDER BY Country");
		$db->bind(':id', $id, PDO::PARAM_STR);
		$getcount = $db->fetchCount();
		$getRs = $db->fetchSingle();




		$ans .= "[";
		for ($x = 0; $x < count($getRs); $x++) {
			if ($x == (count($getRs) - 1)) {
				$comma = "";
			} else {
				$comma = ",";
			}
			$ans .= "'" . $getRs[$x] . "'$comma";
		}
		$ans .= "]";
		return $ans;
		$db = NULL;
	}
} // end of class