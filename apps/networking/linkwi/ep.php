<?php

// Define API endpoint and authentication token

const API_TOKEN = 'EZTK196adcd67f58458aa41b48e8e7cd3210QXLChsVs2vLbz33QN73wpg';
const API_ENDPOINT = 'https://username:EZTK196adcd67f58458aa41b48e8e7cd3210QXLChsVs2vLbz33QN73wpg@https://linkwi.co/linkwi/easypost-webhook';

// Define the shipment details
$shipment = [
    'to_address' => [
        'name' => 'John Doe',
        'street1' => '123 Destination St',
        'city' => 'Destination City',
        'state' => 'DC',
        'zip' => '12345',
        'country' => 'US'
    ],
    'from_address' => [
        'name' => 'Jane Smith',
        'street1' => '456 Origin St',
        'city' => 'Origin City',
        'state' => 'OC',
        'zip' => '67890',
        'country' => 'US'
    ],
    'return_address' => [
        'name' => 'Jane Smith',
        'street1' => '456 Origin St',
        'city' => 'Origin City',
        'state' => 'OC',
        'zip' => '67890',
        'country' => 'US'
    ],
    'parcel' => [
        'length' => 10,
        'width' => 5,
        'height' => 5,
        'weight' => 2
    ]
];

// Make an API call to create the shipment
$response = createShipment($shipment);

// Display the response
echo $response;

function createShipment($shipment) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, API_ENDPOINT);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($shipment));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . API_TOKEN,
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return 'Error:' . curl_error($ch);
    }

    curl_close($ch);

    return $response;
}

?>