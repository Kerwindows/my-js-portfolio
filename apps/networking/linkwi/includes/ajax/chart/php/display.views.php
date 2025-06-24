<?php
require('../../../../../includes/linkwi.php');
//action.php

$connect = new dbase;

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
		$order_column = array('UniqueID', 'CityCount','City', 'Date');

		$main_query = "SELECT UniqueID, COUNT(City) AS CityCount,City, Date FROM View_Stat 
		";

		$search_query = 'WHERE Date <= "'.date('Y-m-d').'" AND ';

		if(isset($_POST["start_date"], $_POST["end_date"]) && $_POST["start_date"] != '' && $_POST["end_date"] != '')
		{
			$search_query .= 'Date >= "'.$_POST["start_date"].'" AND Date <= "'.$_POST["end_date"].'" AND ';
		}

		if(isset($_POST["search"]["value"]))
		{
			$search_query .= '(UniqueID LIKE "%'.$_POST["search"]["value"].'%" OR City LIKE "%'.$_POST["search"]["value"].'%" OR Date LIKE "%'.$_POST["search"]["value"].'%")';
		}



		$group_by_query = " GROUP BY Date, City ";

		$order_by_query = "";

		if(isset($_POST["order"]))
		{
			$order_by_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_by_query = 'ORDER BY Date DESC ';
		}

		$limit_query = '';

		if($_POST["length"] != -1)
		{
			$limit_query = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$connect->query($main_query . $search_query . $group_by_query . $order_by_query);

		$statement = $connect->fetchMultiple();

		$filtered_rows = $connect->fetchCount();

		$connect->query($main_query . $group_by_query);

		$statement = $connect->fetchMultiple();

		$total_rows = $connect->fetchCount();

		$connect->query($main_query . $search_query .'AND UniqueID ="'.$_POST["uniqueid"].'"'. $group_by_query . $order_by_query . $limit_query);
		$result = $connect->fetchMultiple();
		$data = array();

		foreach($result as $row)
		{
			$sub_array = array();

			$sub_array[] = $row['UniqueID'];
			$sub_array[] = $row['CityCount'];
			$sub_array[] = $row['Date'];
			$sub_array[] = $row['City'];
			
			

			$data[] = $sub_array;
		}

		$output = array(
			"draw"			=>	intval($_POST["draw"]),
			"recordsTotal"	=>	$total_rows,
			"recordsFiltered" => $filtered_rows,
			"data"			=>	$data
		);

		echo json_encode($output);
	}
}