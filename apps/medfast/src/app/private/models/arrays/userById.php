<?php
$userByIdArray = [
    '11223344' => [
        'uid' => '11223344',
        'fname' => 'Danniella',
        'lname' => 'Sims',
        'mname' => '',
        'alias' => 'Candy',
        'dob' => '1995-07-29T09:00:00.000Z',
        'sex' => 'Female',
        'image' => '/assets/img/patients/500-09.jpg',
        'email' => 'danniella@mail.com',
        'role' => 'patient',
        'phone' => '8687985678',
        'address' => '',
        'postal_code' => '',
        'religion' => '',
        'union_status' => '',
        'city' => 'Chaguanas',
        'town' => 'Enterprise',
        'country' => 'Trinidad and Tobago',
        'ethnicity' => 'African',
        'mother_maiden_name' => 'Edison',
        'about' => 'Born and raised on the lush island of Trinidad, I am deeply connected to the vibrant culture, spirituality, and natural beauty that surrounds me.',
        'occupation' => 'Home maker',
        'registered_on' => '2024-03-29',
        'status' => 'active',
        'vitals' => [
            'uid' => '11223344',
            'cholesterol' => '80,60',
            'blood_pressure' => '120,80',
            'glucose' => '20',
            'heart_rate' => '60',
            'sleep' => '7,20',
            'temperature' => '36.6',
            'weight' => '240',
            'height' => '180'
        ],
        'emergency_contact' => [
            'uid' => '11223344',
            'fname' => 'Kerwin',
            'lname' => 'Thomas',
            'relationship' => 'Brother in-laws',
            'phone' => '3213153842'
        ],
        'next_of_kin' => [
            'uid' => '11223344',
            'fname' => 'Damien',
            'lname' => 'Williams',
            'relationship' => 'Brother',
            'phone' => '5553153842'
        ],
        'allergies' => [
            [
                'uid' => '11223344',
                'allergy' => 'Peanuts',
                'symptom' => 'Swelling of cheeks',
            ],
            [
                'uid' => '11223344',
                'allergy' => 'Dust',
                'symptom' => 'Sneezing, runny nose, red, watering eyes.',
            ],
            [
                'uid' => '11223344',
                'allergy' => 'Penicillin',
                'symptom' => 'Short breath',
            ],
            [
                'uid' => '11223344',
                'allergy' => 'Pollen',
                'symptom' => 'Itching of the nose or throat',
            ],
        ],
        'medications' => [
            [
                'uid' => '11223344',
                'icon' => 'fas fa-syringe pill-style text-primary',
                'medicine' => 'Albuterol Inhaler',
                'dosage' => 'Inhale 2 puffs every 4-6 hours as needed for wheezing or shortness of breath. Rinse mouth after each use.',
                'administered_on' => '2024-03-10T09:00:00.000Z',
            ],
            [
                'uid' => '11223344',
                'icon' => 'fas fa-capsules pill-style text-primary',
                'medicine' => 'Glimepiride',
                'dosage' => '1 caplet every 4 to 6 hours while symptoms persist. Do not use more than 6 caplets in any 24 hours',
                'administered_on' => '2024-03-10T09:00:00.000Z',
            ],
            [
                'uid' => '11223344',
                'icon' => 'fas fa-tablets pill-style text-primary',
                'medicine' => 'Lisinopril',
                'dosage' => 'Take 10 mg orally once a day. Monitor blood pressure regularly.',
                'administered_on' => '2024-03-10T09:00:00.000Z',
            ],
        ],
        'appointments_this_month' => [
            [
                'uid' => '11223344',
                'did' => '55555',
                'startDate' => '2024-03-10T08:00:00.000Z',
                'endDate' => '2024-03-10T09:00:00.000Z',
                'summary' => 'Meeting with Dr. Lalema',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'uid' => '11223344',
                'did' => '55555',
                'startDate' => '2024-03-10T09:00:00.000Z',
                'endDate' => '2024-03-10T10:00:00.000Z',
                'summary' => 'Monthly checkup',
            ],
            [
                'uid' => '11223344',
                'did' => '55555',
                'startDate' => '2024-03-12T14:00:00.000Z',
                'endDate' => '2024-03-12T15:00:00.000Z',
                'summary' => 'Doctor\'s Appointment',
            ],
        ],
        'last_3_onschedule_appointments' => [
            [
                'uid' => '11223344',
                'name' => 'Dr. Marcus Williams',
                'image' => 'image3.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'uid' => '11223344',
                'name' => 'Dr. Andrea Lalema',
                'image' => 'image8.jpg',
                'reason' => 'Dermatology',
                'schedule' => '10.05.2022',
            ],
            [
                'uid' => '11223344',
                'name' => 'Dr. William Stephin',
                'image' => 'image7.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ]
        ],
        'last_3_missed_appointments' => [
            [
                'uid' => '11223344',
                'name' => 'Dr. William Stephin',
                'image' => 'image7.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'uid' => '11223344',
                'name' => 'Dr. Andrea Lalema',
                'image' => 'image8.jpg',
                'reason' => 'Dermatology',
                'schedule' => '10.05.2022',
            ],
            [
                'uid' => '11223344',
                'name' => 'Dr. Linda Sammy',
                'image' => 'image9.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ]
        ],
        'last_3_passed_appointments' => [
            [
                'uid' => '11223344',
                'name' => 'Dr. Andrea Lalema',
                'image' => 'image8.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'uid' => '11223344',
                'name' => 'Dr. Marcus',
                'image' => 'image3.jpg',
                'reason' => 'Dermatology',
                'schedule' => '10.05.2022',
            ],
            [
                'uid' => '11223344',
                'name' => 'Dr. William Stephin',
                'image' => 'image7.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ]
        ]
    ],
    '44332211' => [
        'uid' => '44332211',
        'fname' => 'Luke',
        'lname' => 'Cloudwalker',
        'mname' => 'Sky',
        'alias' => 'Farmer',
        'dob' => '1980-03-10T09:00:00.000Z',
        'sex' => 'Male',
        'image' => '/assets/img/patients/500-08.jpg',
        'role' => 'patient',
        'phone' => '8687987675',
        'city' => 'Chaguanas',
        'town' => 'Arouca',
        'address' => '',
        'country' => 'Trinidad and Tobago',
        'postal_code' => '',
        'religion' => '',
        'union_status' => '',
        'email' => 'luke@mail.com',
        'ethnicity' => 'African',
        'about' => 'I am a farmer with a passion for healthful living. My life is guided by the principles of love, peace, and unity.',
        'occupation' => 'Farmer',
        'mother_maiden_name' => 'Douglas',
        'registered_on' => '2024-03-27',
        'status' => 'inactive',
        'vitals' => [
            'uid' => '44332211',
            'cholesterol' => '76,40',
            'blood_pressure' => '110,90',
            'glucose' => '20',
            'heart_rate' => '60',
            'sleep' => '9,00',
            'temperature' => '32.6',
            'weight' => '199',
            'height' => '177'
        ],
        'emergency_contact' => [
            'uid' => '44332211',
            'fname' => 'James',
            'lname' => 'Brown',
            'relationship' => 'Brother',
            'phone' => '3213153842'
        ],
        'next_of_kin' => [
            'uid' => '44332211',
            'fname' => 'Marsha',
            'lname' => 'Mendez',
            'relationship' => 'Sister',
            'phone' => '7863153842'
        ],
        'allergies' => [
            [
                'uid' => '44332211',
                'allergy' => 'Peanuts',
                'symptom' => 'Swelling of cheeks',
            ],
            [
                'uid' => '44332211',
                'allergy' => 'Dust',
                'symptom' => 'Runny nose',
            ],
            [
                'uid' => '44332211',
                'allergy' => 'Pollen',
                'symptom' => 'Itching of the nose or throat',
            ],
        ],
        'medications' => [
            [
                'uid' => '44332211',
                'icon' => 'fas fa-syringe pill-style text-primary',
                'medicine' => 'Albuterol Inhaler',
                'dosage' => 'Inhale 2 puffs every 4-6 hours as needed for wheezing or shortness of breath. Rinse mouth after each use.',
                'administered_on' => '2024-03-10T09:00:00.000Z',
            ],
            [
                'uid' => '44332211',
                'icon' => 'fas fa-capsules pill-style text-primary',
                'medicine' => 'Glimepiride',
                'dosage' => '1 caplet every 4 to 6 hours while symptoms persist. Do not use more than 6 caplets in any 24 hours',
                'administered_on' => '2024-03-10T09:00:00.000Z',
            ],
        ],
        'appointments_this_month' => [
            [
                'uid' => '44332211',
                'startDate' => '2024-03-10T08:00:00.000Z',
                'endDate' => '2024-03-10T09:00:00.000Z',
                'summary' => 'Meeting with Dr. Lalema',
            ],
            [
                'uid' => '44332211',
                'startDate' => '2024-03-10T09:00:00.000Z',
                'endDate' => '2024-03-10T10:00:00.000Z',
                'summary' => 'Monthly checkup',
            ],
            [
                'uid' => '44332211',
                'startDate' => '2024-03-12T14:00:00.000Z',
                'endDate' => '2024-03-12T15:00:00.000Z',
                'summary' => 'Doctor\'s Appointment',
            ],
        ],
        'last_3_onschedule_appointments' => [
            [
                'uid' => '44332211',
                'name' => 'Dr. Marcus Williams',
                'image' => 'image3.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'uid' => '44332211',
                'name' => 'Dr. Andrea Lalema',
                'image' => 'image8.jpg',
                'reason' => 'Dermatology',
                'schedule' => '10.05.2022',
            ]
        ],
        'last_3_missed_appointments' => [
            [
                'uid' => '44332211',
                'name' => 'Dr. William Stephin',
                'image' => 'image7.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'uid' => '44332211',
                'name' => 'Dr. Linda Sammy',
                'image' => 'image9.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ]
        ],
        'last_3_passed_appointments' => [
            [
                'uid' => '44332211',
                'name' => 'Dr. Andrea Lalema',
                'image' => 'image8.jpg',
                'reason' => 'Dermatology',
                'schedule' => '12.05.2022',
            ],
            [
                'uid' => '44332211',
                'name' => 'Dr. Marcus',
                'image' => 'image3.jpg',
                'reason' => 'Dermatology',
                'schedule' => '10.05.2022',
            ],
            [
                'uid' => '44332211',
                'name' => 'Dr. Mark Jikaran',
                'image' => 'image7.jpg',
                'reason' => 'Flu shot',
                'schedule' => '12.05.2022',
            ]
        ]
    ]
    // Add more users here, using their UID as the key
];