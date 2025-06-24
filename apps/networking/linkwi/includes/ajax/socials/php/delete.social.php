<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require('../../../../../includes/linkwi.php');


    $db = new dbase;
    $urlId = $_POST['urlId'];

    // Use a prepared statement with a parameter placeholder for the 'id' value
    $db->query("DELETE FROM `socials` WHERE `id` = :urlId");

    // Bind the 'id' value to the parameter placeholder
    $db->bind(':urlId', $urlId, PDO::PARAM_INT);

    // Execute the prepared statement
    if ($db->execute()) {
        $db->closeConnection();
        echo json_encode(["ponse" => "success"]);
    } else {
        $db->closeConnection();
        echo json_encode(["ponse" => "error"]);
    }


}