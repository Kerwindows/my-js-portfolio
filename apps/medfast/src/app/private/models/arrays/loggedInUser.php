<?php 
$loggedInUserArray = [
   'jessica@medfast.com' => [
        'uid' => '55667788',
        'title'=>'Dr.',
        'fname' => 'Jessica',
        'lname' => 'Alba',
        'dob' => '1985-08-12',
        'email'=>'jessica@medfast.com',
        'sex' => 'Female',
        'image' => '/assets/img/patients/500-05.jpg',
        'role' => 'doctor',
        'registered_on' => '2024-03-29',
        'vitals' => [
            'cholesterol' => '80,60',
            'blood_pressure' => '120,80',
            'glucose' => '20',
            'heart_rate' => '60',
            'sleep' => '7,20',
            'temperature' => '36.6',
            'weight' => '220',
            'height' => '200'
        ],
        
        'appointments_this_month' => [
            [
                'startDate' => '2024-03-10T08:00:00.000Z',
                'endDate' => '2024-03-10T09:00:00.000Z',
                'summary' => 'Meeting with Dr. Lalema',
            ],
            [
                'startDate' => '2024-03-10T09:00:00.000Z',
                'endDate' => '2024-03-10T10:00:00.000Z',
                'summary' => 'Monthly checkup',
            ],
            [
                'startDate' => '2024-03-12T14:00:00.000Z',
                'endDate' => '2024-03-12T15:00:00.000Z',
                'summary' => 'Doctor\'s Appointment',
            ],
        ],
        'last_3_onschedule_appointments' => [
            [
                'name' => 'Dr. Marcus Williams',
                'image' => 'image3.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'name' => 'Dr. Andrea Lalema',
                'image' => 'image8.jpg',
                'reason' => 'Dermatology',
                'schedule' => '10.05.2022',
            ],
            [
                'name' => 'Dr. William Stephin',
                'image' => 'image7.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ]
        ],
        'last_3_missed_appointments' => [
            [
                'name' => 'Dr. William Stephin',
                'image' => 'image7.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'name' => 'Dr. Andrea Lalema',
                'image' => 'image8.jpg',
                'reason' => 'Dermatology',
                'schedule' => '10.05.2022',
            ],
            [
                'name' => 'Dr. Linda Sammy',
                'image' => 'image9.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ]
        ],
        'last_3_passed_appointments' => [
            [
                'name' => 'Dr. Andrea Lalema',
                'image' => 'image8.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'name' => 'Dr. Marcus',
                'image' => 'image3.jpg',
                'reason' => 'Dermatology',
                'schedule' => '10.05.2022',
            ],
            [
                'name' => 'Dr. William Stephin',
                'image' => 'image7.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ]
        ]
    ],
    'danniella@mail.com' => [
        'uid' => '11223344',
        'title'=>'',
        'uid' => '11223344',
        'fname' => 'Danniella',
        'lname' => 'Sims',
        'email'=>'danniella@mail.com',
        'dob' => '2000-05-29',
        'sex' => 'Female',
        'image' => '/assets/img/patients/500-09.jpg',
        'role' => 'patient',
        'registered_on' => '2024-03-29',
        'vitals' => [
            'cholesterol' => '80,60',
            'blood_pressure' => '120,80',
            'glucose' => '20',
            'heart_rate' => '60',
            'sleep' => '7,20',
            'temperature' => '36.6',
            'weight' => '240',
            'height' => '180'
        ],
        'allergies' => [
            [
                'allergy' => 'Peanuts',
                'symptom' => 'Swelling of cheeks',
            ],
            [
                'allergy' => 'Dust',
                'symptom' => 'Sneezing, runny nose, red, watering eyes.',
            ],
            [
                'allergy' => 'Penicillin',
                'symptom' => 'Short breath',
            ],
            [
                'allergy' => 'Pollen',
                'symptom' => 'Itching of the nose or throat',
            ],
        ],
        'medications' => [
            [
                'icon' => 'fas fa-syringe pill-style text-primary',
                'medicine' => 'Albuterol Inhaler',
                'administered_on' => '2024-03-10T09:00:00.000Z',
            ],
            [
                'icon' => 'fas fa-capsules pill-style text-primary',
                'medicine' => 'Glimepiride',
                'administered_on' => '2024-03-10T09:00:00.000Z',
            ],
            [
                'icon' => 'fas fa-tablets pill-style text-primary',
                'medicine' => 'Lisinopril',
                'administered_on' => '2024-03-10T09:00:00.000Z',
            ],
        ],
        'appointments_this_month' => [
            [
                'startDate' => '2024-03-10T08:00:00.000Z',
                'endDate' => '2024-03-10T09:00:00.000Z',
                'summary' => 'Meeting with Dr. Lalema',
            ],
            [
                'startDate' => '2024-03-10T09:00:00.000Z',
                'endDate' => '2024-03-10T10:00:00.000Z',
                'summary' => 'Monthly checkup',
            ],
            [
                'startDate' => '2024-03-12T14:00:00.000Z',
                'endDate' => '2024-03-12T15:00:00.000Z',
                'summary' => 'Doctor\'s Appointment',
            ],
        ],
        'last_3_onschedule_appointments' => [
            [
                'name' => 'Dr. Marcus Williams',
                'image' => 'image3.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'name' => 'Dr. Andrea Lalema',
                'image' => 'image8.jpg',
                'reason' => 'Dermatology',
                'schedule' => '10.05.2022',
            ],
            [
                'name' => 'Dr. William Stephin',
                'image' => 'image7.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ]
        ],
        'last_3_missed_appointments' => [
            [
                'name' => 'Dr. William Stephin',
                'image' => 'image7.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'name' => 'Dr. Andrea Lalema',
                'image' => 'image8.jpg',
                'reason' => 'Dermatology',
                'schedule' => '10.05.2022',
            ],
            [
                'name' => 'Dr. Linda Sammy',
                'image' => 'image9.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ]
        ],
        'last_3_passed_appointments' => [
            [
                'name' => 'Dr. Andrea Lalema',
                'image' => 'image8.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'name' => 'Dr. Marcus',
                'image' => 'image3.jpg',
                'reason' => 'Dermatology',
                'schedule' => '10.05.2022',
            ],
            [
                'name' => 'Dr. William Stephin',
                'image' => 'image7.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ]
        ]
    ]
    // Add more users here, using their UID as the key
];