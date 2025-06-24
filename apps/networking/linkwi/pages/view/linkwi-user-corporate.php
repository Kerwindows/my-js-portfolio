<?php
session_start();

//redirect if / comes after username
if (substr($_SERVER['REQUEST_URI'], -1) == '/') {
    redirect('/');
}



$db = new dbase;

if(is_null($Username)){

$db->query("SELECT *, NULL as Password FROM Users WHERE Users.Username = '$Corporation'");
$get_user = $db->fetchSingle();
}else{

$db->query("SELECT *, NULL as Password FROM Users WHERE Users.Username = '$Corporation' ORDER BY UserID ASC");
$get_users = $db->fetchMultiple();

// Initial storage array
$get_user = [];

// Example loop to grab specific fields from different rows
foreach($get_users as $index => $get) {
    // For the first row, grab Username, Organization, and IndustryType
    if($get['corporateUsername'] == $Corporation) {
        $get_user['Organization'] = $get['Organization'];
        $get_user['IndustryType'] = $get['IndustryType'];
        $get_user['User_Banner_Image'] = $get['User_Banner_Image'];
        $get_user['CorpEmail'] = $get['EmailAddress'];
    
    }
    // For the second row, grab FirstName and LastName
   elseif($get['corporateUsername'] == $Username) {
        $get_user['UsernameCheck'] = $Username;
        $get_user['Username'] = $get['corporateUsername'];
        $get_user['UniqueID'] = $get['UniqueID'];
        $get_user['FirstName'] = $get['FirstName'];
        $get_user['LastName'] = $get['LastName'];
        $get_user['BusinessEmailAddress'] = $get['BusinessEmailAddress'];
        $get_user['Job'] = $get['Job'];
        $get_user['BusinessContact'] = $get['BusinessContact'];
        $get_user['ProfileImage'] = $get['ProfileImage'];
        $get_user['color'] = $get['color'];
        $get_user['Image_one'] = $get['Image_one'];
        $get_user['Bio'] = $get['Bio'];
        $get_user['AccountType'] = $get['AccountType'];
        $get_user['UserEmail'] = $get['EmailAddress'];
         
    }
}

}

//redirect if username cannot be found
if (empty($get_user['UniqueID'])) {
    redirect('/card/'.$Corporation);
    exit();
}

function uservisit($id)
{
    if (!isset($_COOKIE['visit' . $id])) {
        setCookie('visit' . $id, 'yes', time() + (60 * 60 * 24 * 30));
        $user_ip = getenv('REMOTE_ADDR');
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
        $country = $geo["geoplugin_countryName"];
        $city = $geo["geoplugin_city"];
        $region = $geo["geoplugin_region"];
        $date = date("Y-m-d");
        $db = new dbase;
        $db->query("INSERT INTO View_Stat (UniqueID,City,Country,Region,Date) VALUES (:id,:city,:country,:region,:date)");
        $db->bind(':id', $id, PDO::PARAM_STR);
        $db->bind(':city', $city, PDO::PARAM_STR);
        $db->bind(':country', $country, PDO::PARAM_STR);
        $db->bind(':region', $region, PDO::PARAM_STR);
        $db->bind(':date', $date, PDO::PARAM_STR);
        if ($db->execute()) {
            $db->query("UPDATE Views SET total_count = total_count+1 WHERE UniqueID =:id");
            $db->bind(':id', $id, PDO::PARAM_STR);
            $db->execute();
        }
    }
}


uservisit($get_user['UniqueID']);  // get unique views from profile visits 

$FirstName = $get_user['FirstName'];
$LastName = $get_user['LastName'];
$emailaddress = $get_user['BusinessEmailAddress'];
$Email_check = $get_user['EmailAddress'];
$job = $get_user['Job'];
$role = $get_user['Role'];
$contact = $get_user['BusinessContact'];
$profile_pic = "linkwi/images/profile-images/{$get_user['ProfileImage']}";
$color = $get_user['color'];
$organization = $get_user['Organization'];
$industry_type = $get_user['IndustryType'];
$bio = $get_user['Bio'];

if (is_null($get_user['Image_one']) || $get_user['Image_one'] == "") {
    $logo = "linkwi/images/profile-logos/sampleLogo.jpg";
} else {
    $logo = "linkwi/images/profile-logos/{$get_user['Image_one']}";
}
if (is_null($get_user["User_Banner_Image"]) || $get_user["User_Banner_Image"] == "") {
    $profile_background  = '/linkwi/images/full-width-images/section-bg-19.jpg';
} elseif (strpos($get_user["User_Banner_Image"], "http") !== false) {
    // The string contains "http"
    $profile_background = $get_user["User_Banner_Image"];
} else {
    // The string does not contain "http"
    $profile_background  = '/linkwi/images/profile-backgrounds/' . $get_user["User_Banner_Image"];
}


if (isset($_SESSION['Userdata']['EmailAddress']) and $_SESSION['Userdata']['UniqueID'] == $get_user['UniqueID']) {
    $check = true;
} elseif(isset($_SESSION['Userdata']['EmailAddress']) and $get_user['Username'] === $get_user['UsernameCheck'] AND $_SESSION['Userdata']['EmailAddress'] == $get_user['UserEmail'] || $_SESSION['Userdata']['EmailAddress'] == $get_user['CorpEmail']){
  $check = true;
}
else {
    $check = false;
}

require_once(LINKWI_INCLUDES_PATH . '/linkwi.user.profile.head.min.php');
require_once(LINKWI_VIEW_PATH . '/linkwi-user-content-corporate.php');
require_once(LINKWI_INCLUDES_PATH . '/linkwi.user.profile.footer.php');