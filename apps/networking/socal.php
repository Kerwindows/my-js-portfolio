<?php

require('/includes/linkwi.php');


$db = new dbase;

// Information to be inserted
$country = "Trinidad and Tobago";
$uniqueID = "62b0cad63edc562b0cad63edc7";
$startDate = "2023-01-01";
$endDate = "2023-11-05";
$socialMediaPlatform = "facebook";

// Generate a random number of times to insert data
$minInserts = 200;  // Minimum number of inserts
$maxInserts = 400; // Maximum number of inserts
$numInserts = rand($minInserts, $maxInserts);

// Generate and insert random data between two dates
for ($i = 0; $i < $numInserts; $i++) {
    $randomDate = date("Y-m-d", mt_rand(strtotime($startDate), strtotime($endDate)));
    
    // SQL query to insert data
    $db->query("INSERT INTO View_Social_Stats (City, UniqueID, Date, Social) 
            VALUES ('$country', $uniqueID, '$randomDate', '$socialMediaPlatform')");
    $db->execute();
}





?>