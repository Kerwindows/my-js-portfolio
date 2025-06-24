<?php
ob_start();
session_start();
require_once './src/utils/constants.php';
declare_constants();
require_once UTILS_PATH.'/router.php';
require_once PRIVATE_CLASSES_PATH.'/SiteSettings.php';
// To initialize and use the class
SiteSettings::init();

$nonce = bin2hex(random_bytes(16));  // Generates a secure random nonce
$_SESSION['nonce'] = $nonce;  // Store nonce in session for later validation if needed
header("Content-Security-Policy: script-src 'self' 'nonce-{$nonce}';");


$_SESSION['Userdata'] = array('email' => 'jessica@medfast.com','role'=>'doctor');
//$_SESSION['Userdata'] = array('email' => 'danniella@mail.com','role'=>'patient');

route('/apps/medfast/', function () {
return include(PRIVATE_VIEWS_PATH. '/dashboard.php');
});

route('/apps/medfast/404', function () { 
return include(PRIVATE_VIEWS_PATH.'/404.php');
});

route('/apps/medfast/login', function () { 
return include(PROJECT_PATH.'/login.php');
});

route('/apps/medfast/logout', function () { 
return include(PROJECT_PATH.'/logout.php');
});
route('/apps/medfast/dashboard', function () {
    ensureLoggedIn(["redirectTo" => '/login',"session_email"=>$_SESSION['Userdata']['email']]); 
return include(PRIVATE_VIEWS_PATH . '/dashboard.php');
});

route('/apps/medfast/patient/profile/{uid}', function ($uid) {
   // ensureLoggedIn(["redirectTo" => '/login',"session_email"=>$_SESSION['Userdata']['email']]); 
return include(PRIVATE_VIEWS_PATH . '/patient/patient_public_profile.php');
});

route('/apps/medfast/patients', function () {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);
    
return include(PRIVATE_VIEWS_PATH . '/patient/patients_list.php');
});


route('/apps/medfast/appointments', function () {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);
    
return include(PRIVATE_VIEWS_PATH . '/patient/patients_appointments.php');
});

route('/apps/medfast/patient/add', function () {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);
    
return include(PRIVATE_VIEWS_PATH . '/patient/patient_add.php');
  
});

route('/apps/medfast/patient/adding', function () {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);
return include(PRIVATE_MODELS_PATH . '/db/addPatient.php');
});

route('/apps/medfast/patient/new-appointment/{uid}', function ($uid) {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);
return include(PRIVATE_VIEWS_PATH . '/patient/patient_appointment_add.php');
});


route('/apps/medfast/patient/edit-appointment/{id}', function ($id) {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);
return include(PRIVATE_VIEWS_PATH . '/patient/patient_appointment_edit.php');
});

route('/apps/medfast/patient/appointments/view/{uid}', function ($uid) {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);
return include(PRIVATE_VIEWS_PATH . '/patient/patient_appointments.php');
});

route('/apps/medfast/patient/edit/{uid}', function ($uid) {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);
    
return include(PRIVATE_VIEWS_PATH . '/patient/patient_edit.php');
});

route('/apps/medfast/patient/conditions', function () {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);    
return "ha ha";
});


route('/apps/medfast/patient/conditions/{uid}', function ($uid) {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);    
return include(PRIVATE_VIEWS_PATH . '/patient/patient_conditions.php');
});

route('/apps/medfast/patient/update/{uid}', function ($uid) {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);
    
return include(PRIVATE_MODELS_PATH . '/db/updatePatientById.php');
});

route('/apps/medfast/patient/public-profile/edit/{uid}', function ($uid) {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);
    
return include(PRIVATE_VIEWS_PATH . '/patient/patient_profile_edit.php');
});



route('/apps/medfast/patient/dashboard/{uid}', function ($uid ='') {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);

return include(PRIVATE_VIEWS_PATH . '/patient/patient_dashboard_by_id.php');
});


route('/apps/medfast/patient/visit/new/{id}', function ($id) {
    ensureLoggedIn([
    "redirectTo" => '/login',
    "session_email"=>$_SESSION['Userdata']['email']
    ]); 
    
    authenticationCheck([
    "redirectTo" => '/login',
    "session_role" => $_SESSION['Userdata']['role'],
    'allowed_roles' => ['doctor']
]);
    
return include(PRIVATE_VIEWS_PATH . '/patient/patient_visit_new.php');
});

/**************************************************************/
/*                   		AJAX			       /
/**************************************************************/

route('/apps/medfast/ajax/appointment/calendar', function () { 
    ensureLoggedIn(["redirectTo" => '/login',"session_email"=>$_SESSION['Userdata']['email']]); 
return include(PRIVATE_COMPONENTS_PATH.'/calendars/ajax/appointmentCalendarAjax.php');

});
route('/apps/medfast/ajax/fetch_calendar_events?{uid}', function ($uid) { 
    ensureLoggedIn(["redirectTo" => '/login',"session_email"=>$_SESSION['Userdata']['email']]); 
return include(PRIVATE_MODELS_PATH.'/db/fetch_calendar_events.php');
});
route('/apps/medfast/ajax/add_patient', function () { 
    ensureLoggedIn(["redirectTo" => '/login',"session_email"=>$_SESSION['Userdata']['email']]); 
return include(PRIVATE_MODELS_PATH.'/db/addPatient.php');
});
route('/apps/medfast/ajax/add_appointment?{uid}', function ($uid) { 
    ensureLoggedIn(["redirectTo" => '/login',"session_email"=>$_SESSION['Userdata']['email']]); 
return include(PRIVATE_MODELS_PATH.'/db/addAppointment.php');
});
route('/apps/medfast/ajax/edit_appointment?{id}', function ($id) { 
    ensureLoggedIn(["redirectTo" => '/login',"session_email"=>$_SESSION['Userdata']['email']]); 
return include(PRIVATE_MODELS_PATH.'/db/editAppointment.php');
});
route('/apps/medfast/ajax/patient_disease_substance_abuse', function () { 
    ensureLoggedIn(["redirectTo" => '/login',"session_email"=>$_SESSION['Userdata']['email']]); 
return include(PRIVATE_CONTAINERS_PATH.'/patient/patient_disease_substance_abuse.php');
});


route('/apps/medfast/ajax/insert_condition', function () { 
    ensureLoggedIn(["redirectTo" => '/login',"session_email"=>$_SESSION['Userdata']['email']]); ///double check uid cascade
return include(PRIVATE_MODELS_PATH.'/db/insertCondition.php');
});
route('/apps/medfast/ajax/new-visit?{id}', function ($id) { 
    ensureLoggedIn(["redirectTo" => '/login',"session_email"=>$_SESSION['Userdata']['email']]); 
return include(PRIVATE_MODELS_PATH.'/db/newVisit.php');
});
route('/apps/medfast/ajax/get-patients?{page}&{query}', function ($page,$query) { 
    ensureLoggedIn(["redirectTo" => '/login',"session_email"=>$_SESSION['Userdata']['email']]); 
return include(PRIVATE_MODELS_PATH.'/db/getPatientsListInfiniteScroll.php');
});


$action = $_SERVER['REQUEST_URI'];
dispatch($action);
ob_end_flush();