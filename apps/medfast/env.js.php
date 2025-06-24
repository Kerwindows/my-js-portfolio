<?php

// Get the raw POST data
$rawData = file_get_contents("php://input");

// Decode the JSON data
$data = json_decode($rawData, true);

// Check if the 'acss' value is set and is 'true'
if (isset($data['acss']) && $data['acss'] === 'true') {
    // If it's true, return the key or whatever data you need
    $config = include 'env.php';
    $response = ['key' => $config['PRIVATE_KEY']];
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If 'acss' is not 'true', return an error or an appropriate response
    http_response_code(403);
    echo json_encode(['error' => 'Access denied']);
}