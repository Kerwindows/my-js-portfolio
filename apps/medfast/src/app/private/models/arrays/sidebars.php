<?php 

$sidebarArray = [
    'patient' => [
        [
            'title' => 'Dashboard',
            'icon' => base_url().'/assets/img/icons/menu-icon-01.svg',
            'link' => base_url().'/apps/medfast/dashboard',
            'name' => 'dashboard',
        ],
        [
            'title' => 'Profile',
            'icon' => base_url().'/assets/img/icons/menu-icon-10.svg',
            'link' => base_url().'/apps/medfast/profile',
            'name' => 'profile',
            'submenu' => [], // This menu item does not have a submenu
        ],
        // Add more items as needed for "patient"
    ],
    'doctor' => [
        [
            'title' => 'Dashboard',
            'icon' => base_url().'/assets/img/icons/menu-icon-01.svg',
            'link' => base_url().'/apps/medfast/dashboard',
            'name' => 'dashboard',
        ],
        [
            'title' => 'Patients',
            'icon' => base_url().'/assets/img/icons/menu-icon-01.svg',
            'link' => '#',
            'name' => 'patients',
            'submenu' => [
                ['title' => 'View Patients', 'link' => base_url().'/patients', 'icon' => '', 'name' => 'patients'],
                ['title' => 'View Appointments', 'link' => base_url().'/appointments', 'icon' => '', 'name' => 'appointments'],
                ['title' => 'Add Patient', 'link' => base_url().'/patient/add', 'icon' => '', 'name' => 'add-patient'],
            ],
        ],
         [
            'title' => 'Profile',
            'icon' => base_url().'/assets/img/icons/menu-icon-10.svg',
            'link' => base_url().'profile',
            'name' => 'profile',
        ],
        // Add more menu items specific to "doctor" here...
    ],
    // Add additional roles as needed
];