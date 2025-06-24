<?php

if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}



function fetchPatients($page, $limit = 4, $query = '') {
    $db = new dbase();
    $offset = ($page - 1) * $limit;
    $searchQuery = '%' . $query . '%'; // Prepare query for LIKE statement

    $queryString = "SELECT uid, fname, lname, image, dob, email, sex, phone, registered_on, status 
                    FROM users 
                    WHERE role = :role AND 
                          (fname LIKE :searchQuery OR 
                           lname LIKE :searchQuery OR 
                           email LIKE :searchQuery)
                    ORDER BY id DESC
                    LIMIT :limit OFFSET :offset";

    $db->query($queryString);
    $db->bind(':role', 'patient', PDO::PARAM_STR);
    $db->bind(':searchQuery', $searchQuery, PDO::PARAM_STR);
    $db->bind(':limit', $limit, PDO::PARAM_INT);
    $db->bind(':offset', $offset, PDO::PARAM_INT);
    
    return $db->fetchMultiple();
}

function checkForMoreData($page, $limit, $query = '') {
    $db = new dbase();
    $offset = ($page * $limit); // Correctly set to check beyond current page

    $searchQuery = '%' . $query . '%';

    $morePatientsQuery = "SELECT 1 FROM users 
                          WHERE role = 'patient' AND 
                                (fname LIKE :searchQuery OR 
                                 lname LIKE :searchQuery OR 
                                 email LIKE :searchQuery)
                          LIMIT 1 OFFSET :offset";

    $db->query($morePatientsQuery);
    $db->bind(':searchQuery', $searchQuery, PDO::PARAM_STR);
    $db->bind(':offset', $offset, PDO::PARAM_INT);
    
    return $db->fetchSingle() ? true : false;
}
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 50;  // Define limit to avoid undefined variable warning
$query = isset($_GET['query']) ? $_GET['query'] : ''; // Get the search query if provided

$patients = fetchPatients($page, $limit, $query);
$moreData = checkForMoreData($page, $limit, $query);

header('Content-Type: application/json');
echo json_encode(['data' => $patients, 'morePages' => $moreData]);
exit();