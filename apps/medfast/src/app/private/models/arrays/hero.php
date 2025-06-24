<?php 

$hour = date_time('H');

// Determine the greeting based on the hour
if ($hour < 12) {
    $greeting = 'Good Morning, ';
} elseif ($hour < 17) {
    $greeting = 'Good Afternoon, ';
} elseif ($hour < 21) {
    $greeting = 'Good Evening, ';
} else {
    $greeting = 'Good Night, ';
}

// Define the array with dynamic greeting
$heroArray = [
    'patient' => [
        'greeting' => $greeting,
        'gesture' => 'A truly amazing doctor is hard to find…and impossible to forget',
        'image' => '/assets/img/morning-img-05.png'
    ],
    'doctor' => [
        'greeting' => $greeting,
        'gesture' => 'Have a nice day today',
        'image' => '/assets/img/morning-img-04.png'
    ],
];