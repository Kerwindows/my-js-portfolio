<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Redirect if / comes after username
$request_uri = rtrim($_SERVER['REQUEST_URI'], '/');
if ($_SERVER['REQUEST_URI'] != $request_uri) {
    redirect($request_uri);
}

$_SESSION['Userdata']      = array(
            'EmailAddress' => 'lampstackuser@kerwindows.com',
            'LoginRole' => 'Users',
            'UniqueID' => '66dccb065db3f66dccb065db41',
            'Username' => 'lampstackuser'
        );
        
        
$db = new dbase;
$db->query("SELECT *, NULL as Password FROM Users WHERE Username = :Username");
$db->bind(':Username', $Username, PDO::PARAM_STR);
$get_user = $db->fetchMultiple();

// Redirect if username cannot be found
if (empty($get_user)) {
    return redirect('/');
}

// Reuse the database connection within the uservisit function
function uservisit($id, $db)
{
    // Check if a visit cookie already exists for this user
    if (!isset($_COOKIE['visit' . $id])) {
        // Set a 30-day cookie to track the visit
        setcookie('visit' . $id, 'yes', time() + (60 * 60 * 24 * 30));  

        // Get the user's IP address
        $user_ip = getenv('REMOTE_ADDR');

        // Attempt to retrieve cached geo data for the user's IP address
        $cached_geo = getCachedGeo($user_ip);  // Implement your own caching mechanism

        // If no cached data, fetch the geo data from the geolocation service
        if (!$cached_geo) {
            try {
                $geo_response = @file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip");
                if ($geo_response !== false) {
                    $geo = unserialize($geo_response);
                    cacheGeo($user_ip, $geo);  // Cache the result
                } else {
                    // Handle the error when the geolocation service fails
                    $geo = ['geoplugin_countryName' => 'Unknown', 'geoplugin_city' => 'Unknown', 'geoplugin_region' => 'Unknown'];
                }
            } catch (Exception $e) {
                // Log or handle the error if file_get_contents fails
                error_log("GeoPlugin API Error: " . $e->getMessage());
                $geo = ['geoplugin_countryName' => 'Unknown', 'geoplugin_city' => 'Unknown', 'geoplugin_region' => 'Unknown'];
            }
        } else {
            // Use cached geo data
            $geo = $cached_geo;
        }

        // Extract necessary location details
        $country = $geo["geoplugin_countryName"] ?? 'Unknown';
        $city = $geo["geoplugin_city"] ?? 'Unknown';
        $region = $geo["geoplugin_region"] ?? 'Unknown';
        $date = date("Y-m-d");

        // Begin a transaction to record the view stats and update the view count
        try {
            $db->beginTransaction();

            // Insert the view stat record
            $db->query("INSERT INTO View_Stat (UniqueID, City, Country, Region, Date) VALUES (:id, :city, :country, :region, :date)");
            $db->bind(':id', $id, PDO::PARAM_STR);
            $db->bind(':city', $city, PDO::PARAM_STR);
            $db->bind(':country', $country, PDO::PARAM_STR);
            $db->bind(':region', $region, PDO::PARAM_STR);
            $db->bind(':date', $date, PDO::PARAM_STR);
            $db->execute();

            // Update the total view count
            $db->query("UPDATE Views SET total_count = total_count + 1 WHERE UniqueID = :id");
            $db->bind(':id', $id, PDO::PARAM_STR);
            $db->execute();

            // Commit the transaction
            $db->commit();
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $db->rollBack();
            // Log or handle the error
            error_log("Database Transaction Error: " . $e->getMessage());
        }
    }
}

uservisit($get_user[0]['UniqueID'], $db);  // Get unique views from profile visits

// Extract user details
$FirstName = $get_user[0]['FirstName'];
$LastName = $get_user[0]['LastName'];
$emailaddress = $get_user[0]['BusinessEmailAddress'];
$job = $get_user[0]['Job'];
$contact = $get_user[0]['BusinessContact'];
$profile_pic = "linkwi/images/profile-images/{$get_user[0]['ProfileImage']}";
$color = $get_user[0]['color'];
$organization = $get_user[0]['Organization'];
$industry_type = $get_user[0]['IndustryType'];
$bio = $get_user[0]['Bio'];
$corporateRole = $get_user[0]['Role'];

// Set the logo image
$logo = is_null($get_user[0]['Image_one']) || $get_user[0]['Image_one'] === "" 
    ? "linkwi/images/profile-logos/sampleLogo.jpg" 
    : "linkwi/images/profile-logos/{$get_user[0]['Image_one']}";

// Set the profile background
$profile_background = empty($get_user[0]["User_Banner_Image"]) 
    ? '../linkwi/images/full-width-images/section-bg-19.jpg' 
    : (strpos($get_user[0]["User_Banner_Image"], "http") !== false 
        ? $get_user[0]["User_Banner_Image"] 
        : '../linkwi/images/profile-backgrounds/' . $get_user[0]["User_Banner_Image"]);

// Build the members HTML using output buffering
$members = '';
for ($i = 1; $i < count($get_user); $i++) {
    $members .= <<<HTML
    <!-- Features Item -->
    <a class='members__link' href='/card/{$get_user[$i]['Username']}/{$get_user[$i]['corporateUsername']}' target='_blank'>
        <div class='features-item members__link'>
            <div class='features-icon'>
                <img class='members__img' src='/linkwi/images/profile-images/{$get_user[$i]['ProfileImage']}' alt=''/>
            </div>
            <div class='features-title'>
                <strong class='members__name'>".htmlspecialchars($get_user[$i]['FirstName'])." ".htmlspecialchars($get_user[$i]['LastName'])."</strong>
            </div>
            <div class='features-descr'>
                <p class='members__title'>".htmlspecialchars($get_user[$i]['Job'])."</p>
            </div>
        </div>
    </a>
    <!-- End Features Item -->
HTML;

}

// Check if the user is logged in and if their UniqueID matches
$check = isset($_SESSION['Userdata']['EmailAddress'], $_SESSION['Userdata']['UniqueID'], $get_user[0]['UniqueID']) 
    && $_SESSION['Userdata']['UniqueID'] === $get_user[0]['UniqueID'];

// Include the necessary files
require_once(LINKWI_INCLUDES_PATH . '/linkwi.user.profile.head.min.php');
require_once('linkwi-user-content-new.php');
require_once(LINKWI_INCLUDES_PATH . '/linkwi.user.profile.footer.php');